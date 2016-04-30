<?php
    namespace App\Models\eBay;

    use Illuminate\Database\Eloquent\Model;

    /**
     * Class SocialLogin
     *
     * @package App\Models\eBay\eBayOrderItem
     *
     * @property $order_id
     * @property $ebay_item_id
     * @property $title
     * @property $price
     * @property $qty_purchased
     * @property $ebay_transaction_id
     */
    class eBayOrderItem extends Model
    {

        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'ebay_orders_items';

        /**
         * The attributes that are not mass assignable.
         *
         * @var array
         */
        protected $guarded = ['id'];

        protected $fillable = [
            'order_id',
            'ebay_item_id',
            'title',
            'price',
            'qty_purchased',
            'ebay_transaction_id',
        ];

        public function order() {
            return self::belongsTo(eBayOrder::class);
        }
    }