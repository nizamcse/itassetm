<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitOfMesurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_of_mesurements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('org_id')->unsigned()->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('created_by')
                ->references('id')->on('users');

            $table->foreign('org_id')
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
        Schema::dropIfExists('unit_of_mesurements');
    }
}
