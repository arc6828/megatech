<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTotalDebtCustomerBillingDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_billing_details', function (Blueprint $table) {
            $table->string('code')->nullable();
            $table->float('total_debt',16,2)->nullable();
        });

        Schema::table('supplier_billing_details', function (Blueprint $table) {
            $table->string('code')->nullable();
            $table->float('total_debt',16,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_billing_details', function (Blueprint $table) {
            //
        });
    }
}
