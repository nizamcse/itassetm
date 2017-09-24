<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseRequisitionApprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_requisition_approvals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchase_reqn_id')->unsigned();
            $table->integer('approved_by')->unsigned();
            $table->timestamps();

            $table->foreign('purchase_reqn_id')
                ->references('id')->on('purchase_requisitions');

            $table->foreign('approved_by')
                ->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_requisition_approvals');
    }
}
