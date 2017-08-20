<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_assets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('suba_asset_cd')->nullable();
            $table->string('suba_name')->nullable();
            $table->string('suba_lifetime')->nullable();
            $table->integer('suba_life_unit')->nullable();
            $table->integer('suba_org')->unsigned()->nullable();
            $table->text('suba_des')->nullable();
            $table->string('suba_dep_method')->nullable();
            $table->date('suba_retainment_dt')->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('created_by')
                ->references('id')->on('users');

            $table->foreign('suba_org')
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
        Schema::dropIfExists('sub_assets');
    }
}
