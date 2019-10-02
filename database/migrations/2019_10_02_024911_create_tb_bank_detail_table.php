<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbBankDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_bank_detail', function(Blueprint $table)
		{
			$table->integer('bank_detail_id', true)->comment('id');
			$table->integer('bank_id')->comment('bank_id');
			$table->date('m_date')->comment('เดือนที่');
			$table->float('bring_forword', 10, 0)->comment('ยอดยกมา');
			$table->float('income', 10, 0)->default(0)->comment('ยอดเงินรับ');
			$table->float('outcome', 10, 0)->default(0)->comment('ยอดเงินจ่าย');
			$table->float('balance', 10, 0)->default(0)->comment('ยอดปลายงวด');
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
		Schema::drop('tb_bank_detail');
	}

}
