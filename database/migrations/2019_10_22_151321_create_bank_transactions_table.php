<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBankTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('code')->nullable();
            $table->float('amount')->nullable();
            $table->string('balance')->nullable();
            $table->text('remark')->nullable();
            $table->integer('user_id')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bank_transactions');
    }
}
