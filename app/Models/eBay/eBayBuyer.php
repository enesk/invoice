<?php
    namespace App\Models\eBay;

    use Illuminate\Database\Eloquent\Model;

    /**
     * @package App\Models\eBay\eBayBuyer
     *
     * @property $owner_id
     * @property $ebay_user_id
     * @property $email
     * @property $first_name
     * @property $last_name
     * @property $street1
     * @property $street2
     * @property $zip
     * @property $city
     * @property $country
     * @property $phone
     * @property $address_id
     * @property $invoice
     */
    class eBayBuyer extends Model
    {

        protected $table = 'ebay_buyers';

        protected $fillable = [
            'owner_id',
            'ebay_user_id',
            'email',
            'first_name',
            'last_name',
            'street1',
            'street2',
            'zip',
            'city',
            'country',
            'phone',
            'address_id',
            'invoice',
        ];

        public function order()
        {
            return $this->hasOne(eBayOrder::class, 'buyer_id');
        }

        public function scopeWithIdenticalAddress($query)
        {
            $data = $query->where('invoice', 1)->get();
            if ($data->isEmpty()):
                return $query->where('invoice', 0);
            endif;

            return $query->where('invoice', 1);
        }

        public function scopeInvoiceAddress($query)
        {
            $data = $query->where('invoice', 0)->get();
            if ($data->isEmpty()):
                return $query->where('invoice', 1);
            endif;

            return $query->where('invoice', 0);
        }

        public
        function addOrder(
            $order
        ) {
            $this->order()->create($order);
        }
    }
