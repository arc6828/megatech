<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReturnOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('code')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->string('purchase_receive_code')->nullable();
            $table->integer('tax_type_id')->nullable();
            $table->integer('purchase_status_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->text('remark')->nullable();
            $table->float('total_before_vat')->nullable();
            $table->float('vat')->nullable();
            $table->float('vat_percent')->nullable();
            $table->float('total_after_vat')->nullable();
            $table->integer('revision')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('return_orders');
    }
}
