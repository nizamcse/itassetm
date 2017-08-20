<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address');
            $table->string('contact_person');
            $table->string('contact_no');
            $table->string('web')->nullable();
            $table->string('trade_no')->nullable();
            $table->string('vat_no')->nullable();
            $table->string('company')->nullable();
            $table->string('org')->nullable();
            $table->integer('created_by')->unsigned();
            $table->timestamps();

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
        Schema::dropIfExists('vendors');
    }
}
