<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetTypeApprovalEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_type_approval_employees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('budget_type')->unsigned();
            $table->integer('employee_id')->unsigned();
            $table->integer('employee_order')->nullable();
            $table->integer('budget_org')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->timestamps();

            $table->foreign('budget_type')
                ->references('id')->on('budget_types');

            $table->foreign('budget_org')
                ->references('id')->on('Organizations');

            $table->foreign('employee_id')
                ->references('id')->on('employees');

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
        Schema::dropIfExists('budget_type_approval_employees');
    }
}