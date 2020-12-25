<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSupplierPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('doc_no')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->string('role')->nullable();
            $table->text('remark')->nullable();
            $table->string('round')->nullable();
            $table->integer('supplier_billing_id')->nullable();
            $table->float('discount')->nullable();
            $table->float('debt_total')->nullable();
            $table->float('cash')->nullable();
            $table->float('credit')->nullable();
            $table->float('tax')->nullable();
            $table->float('payment_total')->nullable();
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
        Schema::drop('supplier_payments');
    }
}
