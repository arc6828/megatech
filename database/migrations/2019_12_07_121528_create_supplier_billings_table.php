<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSupplierBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_billings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('doc_no')->nullable();
            $table->float('total')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->string('condition_billing')->nullable();
            $table->string('condition_cheque')->nullable();
            $table->date('date_billing')->nullable();
            $table->date('date_cheque')->nullable();
            $table->text('remark')->nullable();
            $table->integer('user_id')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('supplier_billings');
    }
}
