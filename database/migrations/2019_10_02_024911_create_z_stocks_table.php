<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZStocksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('z_stocks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('product_id')->nullable();
			$table->integer('amount')->nullable();
			$table->string('action', 191)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('z_stocks');
	}

}
