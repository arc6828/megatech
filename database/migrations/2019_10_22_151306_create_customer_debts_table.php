<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomerDebtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_debts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('doc_no')->nullable();
            $table->date('date')->nullable();
            $table->integer('customer_id')->nullable();
            $table->float('discount')->nullable();
            $table->float('amount')->nullable();
            $table->float('vat_percent')->nullable();
            $table->float('vat')->nullable();
            $table->float('total_before_vat')->nullable();
            $table->float('total')->nullable();
            $table->integer('tax_type_id')->nullable();
            $table->date('completed_at')->nullable();
            $table->string('tax_category')->nullable();
            $table->string('round')->nullable();
            $table->string('type_debt')->nullable();
            $table->string('debt_duration')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('role')->nullable();
            $table->string('reference')->nullable();
            $table->integer('zone_id')->nullable();
            $table->integer('cheque_id')->nullable();
            $table->integer('payment_method')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('customer_debts');
    }
}
