<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTotolBeforeVatToPurchaseOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_purchase_order', function (Blueprint $table) {
            //$table->string('payment_method')->nullable();
            //$table->float('max_credit',16,2)->nullable();
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
        Schema::table('tb_purchase_order', function (Blueprint $table) {
            //
        });
    }
}
