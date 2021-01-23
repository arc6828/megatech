<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGaurdStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gaurd_stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('code')->nullable();
            $table->string('type')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('amount_in_stock')->nullable();
            $table->integer('pending_in')->nullable();
            $table->integer('pending_out')->nullable();
            $table->integer('product_id')->nullable();
            $table->text('remark')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('gaurd_stocks');
    }
}
