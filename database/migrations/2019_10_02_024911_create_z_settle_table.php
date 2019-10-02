<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZSettleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('z_settle', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('id_settle', 100);
			$table->string('id_customer', 100);
			$table->string('type_tax', 100);
			$table->string('id_user', 100);
			$table->string('id_department', 100);
			$table->string('sale_area', 100);
			$table->string('tax_liability', 100);
			$table->date('date_settle');
			$table->integer('debt_period');
			$table->date('deadline_settle');
			$table->integer('id_job');
			$table->string('ref_number', 100);
			$table->string('tax_filing', 100);
			$table->integer('id_account');
			$table->float('total_settle', 10, 0);
			$table->string('id_deposit', 100)->nullable();
			$table->text('discount', 65535)->nullable();
			$table->float('total_deposit', 10, 0)->nullable();
			$table->float('tax', 10, 0);
			$table->float('tax_value', 10, 0);
			$table->float('cash_receipt', 10, 0)->nullable();
			$table->float('total', 10, 0);
			
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
		Schema::drop('z_settle');
	}

}
