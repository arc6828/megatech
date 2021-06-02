<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeOrderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_order_detail', function (Blueprint $table) {
            $table->integer("order_detail_status_id")->default(null)->change();
            $table->integer("approved_amount")->default(null)->change();

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
