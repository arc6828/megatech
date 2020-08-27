<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeliveryDurationToTbOrderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_order_detail', function (Blueprint $table) {
            $table->string('delivery_duration')->nullable();
        });
        Schema::table('tb_order_detail2', function (Blueprint $table) {
            $table->string('delivery_duration')->nullable();
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
