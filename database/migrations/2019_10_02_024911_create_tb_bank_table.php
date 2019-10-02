<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbBankTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_bank', function(Blueprint $table)
		{
			$table->integer('bank_id', true)->comment('id');
			$table->string('bank_code', 10)->comment('รหัสธนาคาร');
			$table->string('bank_name', 100)->comment('รายละเอียด');
			$table->string('bank_branch', 100)->comment('สาขา');
			$table->integer('account_id')->nullable()->comment('รหัสผังบัญชี');
			$table->string('book_bank_serial', 100)->nullable()->comment('เลขที่บัญชีธนาคาร');
			$table->integer('bring_forward')->nullable()->default(0)->comment('ยอดยกมา');
			
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
		Schema::drop('tb_bank');
	}

}
