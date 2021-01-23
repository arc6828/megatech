<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbSalesStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_sales_status', function(Blueprint $table)
		{
			$table->integer('sales_status_id', true);
			$table->string('sales_status_name', 100);
			$table->string('category', 100)->comment('หมวดหมู่');
			
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tb_sales_status');
	}

}
