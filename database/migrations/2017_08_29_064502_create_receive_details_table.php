<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiveDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receive_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_id')->unsigned()->nullable();
            $table->string('purchase_order_no')->nullable();
            $table->date('purchase_order_date')->nullable();
            $table->string('vendor_invoice_no')->nullable();
            $table->date('vendor_delivery_date')->nullable();
            $table->date('warranty_start_from')->nullable();
            $table->string('product_sl_no')->nullable();
            $table->string('product_licence_no')->nullable();
            $table->integer('receive_id')->unsigned()->nullable();
            $table->integer('warranty_duration')->nullable();
            $table->integer('quantity')->nullable();
            $table->float('price')->nullable();
            $table->integer('asset_id')->unsigned()->nullable();
            $table->integer('received_by')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('vendor_id')
                ->references('id')->on('vendors');

            $table->foreign('receive_id')
                ->references('id')->on('receives');

            $table->foreign('asset_id')
                ->references('id')->on('assets');

            $table->foreign('received_by')
                ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receive_details');
    }
}
