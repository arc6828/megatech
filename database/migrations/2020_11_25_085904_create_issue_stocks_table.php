<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIssueStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('code')->nullable();
            $table->integer('product_id')->nullable();
            $table->string('amount')->nullable();
            $table->integer('status_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->text('remark')->nullable();
            $table->float('total')->nullable();
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
        Schema::drop('issue_stocks');
    }
}
