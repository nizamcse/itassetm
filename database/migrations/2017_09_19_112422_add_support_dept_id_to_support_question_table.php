<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSupportDeptIdToSupportQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('support_questions', function (Blueprint $table) {
            $table->integer('support_dept_id')->unsigned();
            $table->foreign('support_dept_id')
                ->references('id')->on('support_depts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('support_questions', function (Blueprint $table) {
            $table->dropColumn('support_dept_id');
        });
    }
}
