<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReturnInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('code')->nullable();
            $table->integer('customer_id')->nullable();
            $table->string('invoice_code')->nullable();
            $table->integer('tax_type_id')->nullable();
            $table->integer('sales_status_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->text('remark')->nullable();
            $table->float('total_before_vat',16)->nullable();
            $table->float('vat',16)->nullable();
            $table->float('vat_percent',16)->nullable();
            $table->float('total_after_vat',16)->nullable();
            $table->integer('revision')->nullable()->default(0);
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('return_invoices');
    }
}
