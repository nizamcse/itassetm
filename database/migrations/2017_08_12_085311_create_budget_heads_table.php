<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetHeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_heads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('bhead_level')->nullable()->default(0);
            $table->integer('bhead_org')->unsigned()->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('budget_heads');
    }
}
