<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_id')->unsigned();
            $table->integer('asset_id')->unsigned();
            $table->text('problem_description');
            $table->string('sd_remarks')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();

            $table->foreign('service_id')
                ->references('id')->on('services');
            $table->foreign('asset_id')
                ->references('id')->on('assets');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_details');
    }
}
