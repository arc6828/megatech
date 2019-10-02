<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZDebtoutKakTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('z_debtout_kak', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('id_dept', 100);
			$table->string('id_customer', 100);
			$table->string('type_tax', 100);
			$table->string('tax_liability', 100);
			$table->date('date_dept');
			$table->date('deadline');
			$table->string('tax_filing', 100);
			$table->float('total_dept', 10, 0);
			$table->float('tax_value', 10, 0);
			$table->float('tax', 10, 0);
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
		Schema::drop('z_debtout_kak');
	}

}
