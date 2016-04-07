<?php
    namespace App\Models\Access\User;

    use Illuminate\Database\Eloquent\Model;

    /**
     * Class SocialLogin
     *
     * @package App\Models\Access\User
     */
    class Settings extends Model
    {

        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'settings';

        /**
         * The attributes that are not mass assignable.
         *
         * @var array
         */
        protected $guarded = ['id'];

        protected $fillable = [
            'user_id',
            'invoice_number'
        ];

        public function user() {
            return $this->belongsTo(User::class);
        }
    }