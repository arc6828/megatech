<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->string('branch')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('account_no')->nullable();
            $table->float('balance_bring_forword')->nullable();
            $table->float('balance')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bank_accounts');
    }
}
