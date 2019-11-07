<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChequesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cheques', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('doc_no')->nullable();
            $table->date('cheque_date')->nullable();
            $table->string('cheque_type')->nullable();
            $table->string('cheque_no')->nullable();
            $table->float('total')->nullable();
            $table->float('bank_fee')->nullable();
            $table->integer('bank_account_id')->nullable();
            $table->date('passed_cheque_date')->nullable();
            $table->string('reference')->nullable();
            $table->string('status')->nullable();
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
        Schema::drop('cheques');
    }
}
