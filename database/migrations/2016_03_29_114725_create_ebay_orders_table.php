<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEbayOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ebay_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('ebay_order_id');
            $table->float('total');
            $table->string('payment_method');
            $table->string('payment_status');
            $table->float('amount_paid');
            $table->timestamps();
            $table->softDeletes();
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
