<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetTypeApprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_type_approvals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('budget_type_id')->unsigned();
            $table->integer('approved_by')->unsigned();
            $table->timestamps();

            $table->foreign('budget_type_id')
                ->references('id')->on('budget_types');

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
        Schema::dropIfExists('budget_type_approvals');
    }
}
