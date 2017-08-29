<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPurchaseReqIdToPurchaseRequisitionDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_requisition_details', function (Blueprint $table) {

            $table->integer('purchase_req_id')->unsigned();

            $table->foreign('purchase_req_id')
                ->references('id')->on('purchase_requisitions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_requisition_details', function (Blueprint $table) {
            $table->dropColumn('purchase_req_id');
        });
    }
}
