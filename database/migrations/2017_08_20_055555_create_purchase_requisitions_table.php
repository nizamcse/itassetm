<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_requisitions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('budget_type')->unsigned();
            $table->string('particulars')->nullable();
            $table->integer('budget_org')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->integer('status')->nullable()->default(0);
            $table->timestamps();

            $table->foreign('budget_type')
                ->references('id')->on('budget_types');

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
        Schema::dropIfExists('purchase_requisitions');
    }
}
