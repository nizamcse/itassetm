<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('budget_type_year');
            $table->string('budget_type_name');
            $table->integer('budget_type_level_apv')->nullable()->default(0);
            $table->integer('budget_org')->unsigned()->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('created_by')
                ->references('id')->on('users');

            $table->foreign('budget_org')
                ->references('id')->on('organizations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('budget_types');
    }
}
