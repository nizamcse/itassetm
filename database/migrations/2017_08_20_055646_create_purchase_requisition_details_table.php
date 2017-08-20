<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseRequisitionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_requisition_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('asset_id')->unsigned();
            $table->integer('quantity');
            $table->float('approx_price');
            $table->integer('budget_org')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->timestamps();

            $table->foreign('asset_id')
                ->references('id')->on('assets');

            $table->foreign('budget_org')
                ->references('id')->on('Organizations');

            $table->foreign('created_by')
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
        Schema::dropIfExists('purchase_requisition_details');
    }
}
