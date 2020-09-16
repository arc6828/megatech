<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRevisionToAllSalesPurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //SALES
        Schema::table('tb_order', function (Blueprint $table) {
            $table->integer('revision')->nullable()->default(0);
        });
        Schema::table('tb_invoice', function (Blueprint $table) {
            $table->integer('revision')->nullable()->default(0);
            $table->string('parent_invoice')->nullable();
        });
        Schema::table('tb_delivery_temporary', function (Blueprint $table) {
            $table->integer('revision')->nullable()->default(0);
        });
        //PURCHASE
        Schema::table('tb_purchase_order', function (Blueprint $table) {
            $table->integer('revision')->nullable()->default(0);
        });
        Schema::table('tb_purchase_receive', function (Blueprint $table) {
            $table->integer('revision')->nullable()->default(0);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_order', function (Blueprint $table) {
            //
        });
    }
}
