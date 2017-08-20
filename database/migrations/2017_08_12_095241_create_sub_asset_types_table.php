<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubAssetTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_asset_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('sub_level')->nullable();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('sub_type_org')->unsigned()->nullable();
            $table->integer('created_by')->unsigned()->nullable();

            $table->timestamps();

            $table->foreign('created_by')
                ->references('id')->on('users');

            $table->foreign('sub_type_org')
                ->references('id')->on('organizations');

            $table->foreign('parent_id')
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
        Schema::dropIfExists('sub_asset_types');
    }
}
