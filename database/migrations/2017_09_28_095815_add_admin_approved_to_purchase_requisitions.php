<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdminApprovedToPurchaseRequisitions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_requisitions', function (Blueprint $table) {
            $table->boolean('admin_approved')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_requisitions', function (Blueprint $table) {
            $table->dropColumn('admin_approved');
        });
    }
}
