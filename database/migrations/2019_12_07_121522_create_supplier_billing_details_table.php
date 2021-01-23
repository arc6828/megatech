<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSupplierBillingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_billing_details', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('doc_id')->nullable();
            $table->integer('supplier_billing_id')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('supplier_billing_details');
    }
}
