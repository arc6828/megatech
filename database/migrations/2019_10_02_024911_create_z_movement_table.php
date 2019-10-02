<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZMovementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('z_movement', function(Blueprint $table)
		{
			$table->integer('id_move', true)->comment('รหัส');
			$table->integer('id_product')->comment('รหัสสินค้า');
			$table->dateTime('date')->comment('วันที่');
			$table->string('inproduct', 10)->comment('สินค้าเข้า');
			$table->string('outproduct', 10)->comment('สินค้าออก');
			$table->string('receive', 10)->comment('สินค้าค้างรับ');
			$table->string('send', 10)->comment('สินค้าค้างส่ง');
			$table->string('balance', 10)->comment('ยอดคงเหลือสินค้า');
			
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
		Schema::drop('z_movement');
	}

}
