<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_code')->nullable();
            $table->integer('dept_id')->unsigned()->nullable();
            $table->date('joined_at')->nullable();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('designation')->nullable();
            $table->string('location')->nullable();
            $table->string('org')->nullable();
            $table->integer('created_by')->unsigned()->nullable();

            $table->timestamps();

            $table->foreign('dept_id')
                ->references('id')->on('departments');

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
        Schema::dropIfExists('employees');
    }
}
