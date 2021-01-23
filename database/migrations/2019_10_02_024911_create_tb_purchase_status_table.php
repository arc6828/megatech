<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbPurchaseStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_purchase_status', function(Blueprint $table)
		{
			$table->integer('purchase_status_id', true);
			$table->string('purchase_status_name', 100);
			$table->string('category', 100);
			
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
		Schema::drop('tb_purchase_status');
	}

}
