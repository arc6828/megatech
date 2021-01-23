<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbSalesPickingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_sales_picking', function(Blueprint $table)
		{
			$table->integer('sales_picking_id', true);
			$table->string('picking_code', 100)->nullable();
			$table->timestamp('datetime')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->text('remark', 65535)->nullable();
			
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
		Schema::drop('tb_sales_picking');
	}

}
