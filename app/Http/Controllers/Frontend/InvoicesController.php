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
            $invoice = eBayOrderInvoice::find($request->get('id'));
            if (access()->user()->id != $invoice->owner_id):
                return false;
            endif;
            $invoice->update(['invoice_number' => $request->get('invoice_number')]);

            return Redirect::back()->with('flash_success', 'Ihre Daten wurden aktualisert');
        }
    }
