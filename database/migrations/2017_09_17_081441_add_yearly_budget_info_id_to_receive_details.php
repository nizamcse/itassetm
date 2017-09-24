<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddYearlyBudgetInfoIdToReceiveDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('receive_details', function (Blueprint $table) {
            $table->integer('yearly_budget_info_id')->unsigned()->nullable();

            $table->foreign('yearly_budget_info_id')
                ->references('id')->on('yearly_budget_infos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('receive_details', function (Blueprint $table) {
            $table->dropColumn('yearly_budget_info_id');
        });
    }
}
