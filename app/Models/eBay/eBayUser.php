<?php
    namespace App\Models\eBay;

    use App\Models\eBay\eBayOrder;
    use Illuminate\Database\Eloquent\Model;

    /**
     * Class SocialLogin
     *
     * @package App\Models\eBay\eBayUser
     *
     * @property $user_id
     * @property $ebay_id
     * @property $ebay_token
     */
    class eBayUser extends Model
    {

        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'ebay_users';

        /**
         * The attributes that are not mass assignable.
         *
         * @var array
         */
        protected $guarded = ['id'];

        protected $fillable = [
            'user_id',
            'ebay_id',
            'ebay_token'
        ];
        
        public function buyers() {
            return $this->hasMany(eBayOrder::class, 'owner_id');
        }
    }