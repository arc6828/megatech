<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToTableOrderDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_order_detail', function (Blueprint $table) {
            $table->integer('before_approved_amount')->nullable()->comment('จำนวนก่อนอนุมัติ');
            $table->integer('iv_amount')->nullable()->comment('จำนวนที่ออก iv');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_order_detail', function (Blueprint $table) {
            //
        });
    }
}
