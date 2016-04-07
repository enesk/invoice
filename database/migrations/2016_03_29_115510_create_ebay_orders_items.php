<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEbayOrdersItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ebay_orders_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->bigInteger('ebay_item_id');
            $table->string('ebay_item_title');
            $table->float('ebay_item_price');
            $table->integer('ebay_qty_purchased');
            $table->bigInteger('ebay_transaction_id');
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
