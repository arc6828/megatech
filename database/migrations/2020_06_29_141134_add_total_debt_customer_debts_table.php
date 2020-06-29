<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTotalDebtCustomerDebtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_debts', function (Blueprint $table) {
            $table->float('total_debt',16,2)->nullable();
            $table->float('discount',16,2)->nullable()->change();
            $table->float('vat_percent',16,2)->nullable()->change();
            $table->float('vat',16,2)->nullable()->change();
            $table->float('total_before_vat',16,2)->nullable()->change();
            $table->float('total',16,2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_debts', function (Blueprint $table) {
            //
        });
    }
}
