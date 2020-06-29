<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSupplierDebtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_debts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('doc_no')->nullable();
            $table->date('date')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->double('discount',16,2)->nullable();
            $table->double('vat_percent',16,2)->nullable();
            $table->double('vat',16,2)->nullable();
            $table->double('total_before_vat',16,2)->nullable();
            $table->double('total',16,2)->nullable();
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
        Schema::drop('supplier_debts');
    }
}
