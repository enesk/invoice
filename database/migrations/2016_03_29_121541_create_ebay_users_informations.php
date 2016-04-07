<?php
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateEbayUsersInformations extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('ebay_user_information', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id');
                $table->string('email');
                $table->string('first_name');
                $table->string('last_name');
                $table->string('street1');
                $table->string('street2');
                $table->string('zip');
                $table->string('city');
                $table->string('country');
                $table->string('phone');
                $table->string('address_id');
                $table->boolean('invoice');
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            //
        }
    }
