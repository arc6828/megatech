<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZProduct2sTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('z_product2s', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('product_code', 191)->nullable();
			$table->string('product_name', 191)->nullable();
			$table->string('product_detail', 191)->nullable();
			$table->string('brand', 191)->nullable();
			$table->float('promotion_price')->nullable();
			$table->float('floor_price')->nullable();
			$table->float('max_discount_percent')->nullable();
			$table->integer('amount_in_stock')->nullable();
			$table->string('product_unit', 191)->nullable();
			$table->integer('pending_in')->nullable();
			$table->integer('pending_out')->nullable();
			$table->float('normal_price')->nullable();
			$table->string('BARCODE', 191)->nullable();
			$table->float('purchase_price')->nullable();
			$table->string('purchase_ref', 191)->nullable();
			$table->string('ISBN', 191)->nullable();
			$table->integer('quantity')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('z_product2s');
	}

}
