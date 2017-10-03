<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_id')->unsigned();

            $table->string('title');
            $table->string('document');
            $table->timestamps();

            $table->foreign('vendor_id')
                ->references('id')->on('vendors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor_documents');
    }
}
