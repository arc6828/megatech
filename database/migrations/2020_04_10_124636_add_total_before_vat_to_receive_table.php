<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTotalBeforeVatToReceiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_purchase_receive', function (Blueprint $table) {
            $table->string('payment_method')->nullable();
            $table->float('max_credit',16,2)->nullable();
            $table->float('total_before_vat',16,2)->nullable();
            $table->float('vat',16,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('table_purchase_receive', function (Blueprint $table) {
            //
        });
    }
}
