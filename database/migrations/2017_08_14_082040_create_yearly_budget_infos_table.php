<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYearlyBudgetInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yearly_budget_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('budget_type')->unsigned()->nullable();
            $table->integer('budget_head')->unsigned()->nullable();
            $table->string('budget_particulars')->nullable();
            $table->integer('manufacturer_id')->unsigned()->nullable();
            $table->integer('supplier_id')->unsigned()->nullable();
            $table->float('usd_amount')->nullable();
            $table->float('bdt_amount')->nullable();
            $table->float('usd_conversion')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('unit')->unsigned()->nullable();
            $table->integer('org_id')->unsigned()->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('budget_type')
                ->references('id')->on('budget_types');

            $table->foreign('budget_head')
                ->references('id')->on('budget_heads');

            $table->foreign('manufacturer_id')
                ->references('id')->on('manufacturers');

            $table->foreign('supplier_id')
                ->references('id')->on('vendors');

            $table->foreign('created_by')
                ->references('id')->on('users');

            $table->foreign('org_id')
                ->references('id')->on('organizations');

            $table->foreign('unit')
                ->references('id')->on('unit_of_mesurements');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('yearly_budget_infos');
    }
}
