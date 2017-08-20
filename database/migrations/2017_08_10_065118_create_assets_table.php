<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('asset_old_cd')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('asset_type')->unsigned()->nullable();
            $table->integer('asset_manufac')->unsigned()->nullable();
            $table->integer('asset_dept')->unsigned()->nullable();
            $table->integer('asset_sec')->unsigned()->nullable();
            $table->integer('asset_emp')->unsigned()->nullable();
            $table->string('asset_life')->nullable();
            $table->integer('asset_life_unit')->nullable();
            $table->integer('asset_dep_method')->nullable();
            $table->date('asset_retainment_dt')->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('asset_org')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('asset_type')
                ->references('id')->on('asset_types');

            $table->foreign('asset_manufac')
                ->references('id')->on('manufacturers');

            $table->foreign('asset_dept')
                ->references('id')->on('departments');

            $table->foreign('asset_sec')
                ->references('id')->on('sections');

            $table->foreign('asset_emp')
                ->references('id')->on('employees');

            $table->foreign('created_by')
                ->references('id')->on('users');

            $table->foreign('asset_org')
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
        Schema::dropIfExists('assets');
    }
}