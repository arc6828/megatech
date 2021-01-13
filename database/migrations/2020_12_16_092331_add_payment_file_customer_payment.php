<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaymentFileCustomerPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_payments', function (Blueprint $table) {
            $table->string('payment_file')->nullable();
        });
        Schema::table('supplier_payments', function (Blueprint $table) {
            $table->string('payment_file')->nullable();
        });

        Schema::table('customer_payment_details', function (Blueprint $table) {
            $table->string('code')->nullable();
            $table->float('total_debt',16,2)->nullable();
            $table->float('total_payment',16,2)->nullable();
            $table->float('total_remain',16,2)->nullable();
            $table->renameColumn('customer_billing_id','customer_payment_id');
        });        

        Schema::table('supplier_payment_details', function (Blueprint $table) {
            $table->string('code')->nullable();
            $table->float('total_debt',16,2)->nullable();
            $table->float('total_payment',16,2)->nullable();
            $table->float('total_remain',16,2)->nullable();
            $table->renameColumn('supplier_billing_id','supplier_payment_id');
        });

        Schema::table('bank_transactions', function (Blueprint $table) {
            $table->string('cheque_code')->nullable();
            $table->string('document_code')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_payments', function (Blueprint $table) {
            //
        });
    }
}
