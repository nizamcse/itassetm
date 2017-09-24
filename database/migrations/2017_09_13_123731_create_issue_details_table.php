<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssueDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('issue_id')->unsigned()->nullable();
            $table->integer('asset_id')->unsigned()->nullable();
            $table->integer('quantity')->nullable();
            $table->string('particulars')->nullable();
            $table->string('sl_no')->nullable();
            $table->integer('reqn_number')->unsigned()->nullable();
            $table->integer('dept_id')->unsigned()->nullable();
            $table->integer('location_id')->unsigned()->nullable();
            $table->integer('employee_id')->unsigned()->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('asset_id')
                ->references('id')->on('assets');
            $table->foreign('created_by')
                ->references('id')->on('users');
            $table->foreign('issue_id')
                ->references('id')->on('issues');
            $table->foreign('dept_id')
                ->references('id')->on('departments');
            $table->foreign('location_id')
                ->references('id')->on('locations');
            $table->foreign('employee_id')
                ->references('id')->on('employees');
            $table->foreign('reqn_number')
                ->references('id')->on('purchase_requisitions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issue_details');
    }
}
