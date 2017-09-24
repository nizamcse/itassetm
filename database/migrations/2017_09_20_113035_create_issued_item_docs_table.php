<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssuedItemDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issued_item_docs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('issued_item_id')->unsigned();
            $table->text('docs');
            $table->timestamps();

            $table->foreign('issued_item_id')
                ->references('id')->on('issue_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issued_item_docs');
    }
}
