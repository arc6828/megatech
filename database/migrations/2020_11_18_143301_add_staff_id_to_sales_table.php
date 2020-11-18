<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStaffIdToSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_quotation', function (Blueprint $table) {
            $table->integer('staff_id')->nullable();
        });
        Schema::table('tb_order', function (Blueprint $table) {
            $table->integer('staff_id')->nullable();
        });
        Schema::table('tb_invoice', function (Blueprint $table) {
            $table->integer('staff_id')->nullable();
        });
        Schema::table('tb_delivery_temporary', function (Blueprint $table) {
            $table->integer('staff_id')->nullable();
        });
        Schema::table('return_invoices', function (Blueprint $table) {
            $table->integer('staff_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_quotation', function (Blueprint $table) {
            //
        });
    }
}
