<?php
    namespace App\Models\eBay;

    use Illuminate\Database\Eloquent\Model;

    /**
     * @package App\Models\eBay\eBayOrder
     *          
     * @property $id
     * @property $user_id
     * @property $ebay_order_id
     * @property $buyer_id
     * @property $total
     * @property $payment_method
     * @property $payment_status
     * @property $amount_paid
     * @property $order_created_at
     *
     */
    class eBayOrder extends Model
    {

        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'ebay_orders';

        /**
         * The attributes that are not mass assignable.
         *
         * @var array
         */
        protected $guarded = ['id'];

        protected $fillable = [
            'user_id',
            'ebay_order_id',
            'buyer_id',
            'total',
            'payment_method',
            'payment_status',
            'amount_paid',
            'order_created_at',
        ];

        public static function checkOrder($orderID)
        {
            $order = self::where('ebay_order_id', $orderID)->first();
            if (isset($order)) {
                return true;
            }

            return false;
        }

        public function items()
        {
            return $this->hasMany(eBayOrderItem::class, 'order_id');
        }

        public function buyer()
        {
            return $this->belongsTo(eBayBuyer::class);
        }

        public function invoice()
        {
            return $this->hasOne(eBayOrderInvoice::class, 'order_id');
        }
    }