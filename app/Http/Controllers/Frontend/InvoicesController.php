<?php
    namespace App\Http\Controllers\Frontend;

    use App\Http\Controllers\Controller;
    use App\Models\eBay\eBayBuyer;
    use App\Models\eBay\eBayOrder;
    use App\Models\eBay\eBayOrderInvoice;
    use App\Models\eBay\eBayOrderItem;
    use Carbon\Carbon;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Redirect;
    use PDF;

    /**
     * Class InvoicesController
     *
     * @package App\Http\Controllers
     */
    class InvoicesController extends Controller
    {

        /**
         * @param $orderID
         *
         * @return mixed
         */
        public function download($orderID)
        {
            $order      = eBayOrder::find($orderID);
            $buyer      = $order->buyer;
            $checkBuyer = eBayBuyer::where('ebay_user_id', $buyer->ebay_user_id);
            if ($checkBuyer->count() > 1):
                $buyer['shipment'] = eBayBuyer::getShipmentDetails($buyer->ebay_user_id);
            endif;
            $price     = $order->total;
            $tax       = $price * 0.19;
            $beforeTax = $price - $tax;
            $data      = [
                'order'     => $order,
                'beforeTax' => $beforeTax,
                'tax'       => $tax,
                'price'     => $price,
                'buyer'     => $buyer,
            ];
            #    return view('frontend.invoice.invoice', $data);
            $pdf = PDF::loadView('frontend.invoice.invoice', $data);

            return $pdf->download('Rechnung-'.$order->invoice->invoice_number.'.pdf');
        }

        public function update(Request $request)
        {
            $invoice = eBayOrderInvoice::find($request->get('invoice_id'));
            if (access()->user()->id != $invoice->owner_id):
                return false;
            endif;
            $invoice->update(['invoice_number' => $request->get('invoice_number')]);
            $buyerID           = $request->get('buyer_id');
            $buyer             = eBayBuyer::find($buyerID);
            $buyer->first_name = $request->get('invoice_first_name');
            $buyer->last_name  = $request->get('invoice_last_name');
            $buyer->street1    = $request->get('invoice_street1');
            $buyer->street2    = $request->get('invoice_street2');
            $buyer->zip        = $request->get('invoice_zip');
            $buyer->city       = $request->get('invoice_city');
            $buyer->save();
            $shipment = $request->get('shipment_buyer_id');
            /* @todo fix it */
            if (isset($shipment) && $shipment > 0):
                $shipmentBuyer             = eBayBuyer::find($shipment);
                $shipmentBuyer->first_name = $request->get('shipment_first_name');;
                $shipmentBuyer->last_name = $request->get('shipment_last_name');
                $shipmentBuyer->street1   = $request->get('shipment_street1');
                $shipmentBuyer->street2   = $request->get('shipment_street2');
                $shipmentBuyer->zip       = $request->get('shipment_zip');
                $shipmentBuyer->city      = $request->get('shipment_city');
                $shipmentBuyer->save();
            endif;
            $shipmentFirstName = $request->get('shipment_first_name');
            if ($shipment == 'new' && !empty($shipmentFirstName)):
                $data = [
                    'owner_id'     => access()->user()->id,
                    'ebay_user_id' => $buyer->ebay_user_id,
                    'invoice'      => 0,
                    'first_name'   => $shipmentFirstName,
                    'last_name'    => $request->get('shipment_last_name'),
                    'street1'      => $request->get('shipment_street1'),
                    'street2'      => $request->get('shipment_street2'),
                    'zip'          => $request->get('shipment_zip'),
                    'city'         => $request->get('shipment_city'),
                ];
                eBayBuyer::create($data);
            endif;

            return Redirect::back()->with('flash_success', 'Kundendaten wurden aktualisert');
        }

        public function edit($invoiceID)
        {
            $invoice          = eBayOrderInvoice::find($invoiceID);
            $buyer            = $invoice->order->buyer;
            $invoice['order'] = $invoice->order;
            $invoice['buyer'] = $buyer;
            $shipmentDetails  = eBayBuyer::getShipmentDetails($buyer->ebay_user_id);
            if ($shipmentDetails):
                $invoice['buyer']['shipment'] = $shipmentDetails;
            endif;
            $data = [
                'invoice' => $invoice,
            ];

            return response()->view('frontend.invoice.modals.edit', $data);
        }

        public function create()
        {
            return response()->view('frontend.invoice.modals.create');
        }

        public function save(Request $request)
        {
            $data         = $request->all();
            $createdBuyer = $this->createBuyer($data);
            $item         = $data['item'];
            $items        = collect($item);
            $total        = $items->sum(function ($item) {
                return $item['price'] * $item['qty_purchased'];
            });
            $order        = $this->createOrder($createdBuyer->id, $total);
            $items->map(function ($item) use ($order) {
                $item['order_id'] = $order->id;
                eBayOrderItem::create($item);
                $settings = access()->user()->settings()->first();
                $settings->increment('invoice_number');
                eBayOrderInvoice::createNewInvoiceNumber(access()->user()->id, $order->id,
                    $settings->invoice_number);
            });

            return Redirect::back()->with('flash_success', 'Auftrag gespeichert');
        }

        private function createOrder($buyerID, $total)
        {
            $order                     = [];
            $order['buyer_id']         = $buyerID;
            $order['total']            = $total;
            $order['payment_method']   = 'Manuell';
            $order['payment_status']   = 'Completed';
            $order['amount_paid']      = $order['total'];
            $order['order_created_at'] = Carbon::now();

            return eBayOrder::create($order);
        }

        /**
         * @param $data
         *
         * @return static
         */
        private function createBuyer($data)
        {
            $buyerDetails             = $data['invoice'];
            $buyerDetails['owner_id'] = access()->user()->id;
            $buyerDetails['invoice']  = 1;
            $createdBuyer             = eBayBuyer::create($buyerDetails);
            $shipmentDetails          = $data['shipment'];
            if (!empty($shipmentDetails['first_name'])):
                $shipmentDetails['owner_id'] = access()->user()->id;
                $shipmentDetails['invoice']  = 0;
                eBayBuyer::create($shipmentDetails);

                return $createdBuyer;
            endif;

            return $createdBuyer;
        }
    }
