<?php
    namespace App\Http\Controllers\Frontend;

    use App\Http\Controllers\Controller;
    use App\Models\eBay\eBayBuyer;
    use App\Models\eBay\eBayOrder;
    use App\Models\eBay\eBayOrderInvoice;
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
            if (isset($shipment)):
                $shipmentBuyer             = eBayBuyer::find($shipment);
                $shipmentBuyer->first_name = $request->get('shipment_first_name');
                $shipmentBuyer->last_name  = $request->get('shipment_last_name');
                $shipmentBuyer->street1    = $request->get('shipment_street1');
                $shipmentBuyer->street2    = $request->get('shipment_street2');
                $shipmentBuyer->zip        = $request->get('shipment_zip');
                $shipmentBuyer->city       = $request->get('shipment_city');
                $shipmentBuyer->save();
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
    }
