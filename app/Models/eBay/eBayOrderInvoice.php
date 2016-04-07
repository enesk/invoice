<?php
    namespace App\Models\eBay;

    use Illuminate\Database\Eloquent\Model;

    /**
     *
     * @package App\Models\eBay\eBayOrderInvoice
     * @property  int $invoice_number
     * @property  int $order_id
     * @property  int $owner_id
     */
    class eBayOrderInvoice extends Model
    {

        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'ebay_orders_invoices';

        /**
         * The attributes that are not mass assignable.
         *
         * @var array
         */
        protected $guarded = ['id'];

        protected $fillable = [
            'owner_id',
            'order_id',
            'invoice_number',
        ];

        public function createNewInvoiceNumber($ownerID, $orderID, $invoiceNumber)
        {
            $invoice = self::where('order_id', $orderID)->first();
            if (!isset($invoice)):
                $invoice = self::create([
                    'owner_id'       => $ownerID,
                    'order_id'       => $orderID,
                    'invoice_number' => $invoiceNumber,
                ]);

                return $invoice->invoice_number;
            endif;

            return $invoice->invoice_number;
        }

        public function order()
        {
            return $this->belongsto(eBayOrder::class, 'order_id');
        }

    }