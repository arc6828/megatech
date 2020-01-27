<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChecklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checklists', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('billing_invoice')->nullable();
            $table->string('billing_po')->nullable();
            $table->string('billing_receipt')->nullable();
            $table->string('billing_envelope')->nullable();
            $table->string('billing_delivery')->nullable();
            $table->string('billing_reference')->nullable();
            $table->string('cheque_billing')->nullable();
            $table->string('cheque_receipt')->nullable();
            $table->string('cheque_po')->nullable();
            $table->string('type')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('supplier_id')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('checklists');
    }
}
