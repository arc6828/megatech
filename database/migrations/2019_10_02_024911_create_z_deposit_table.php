<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZDepositTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('z_deposit', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('id_deposit', 100);
			$table->float('total_deposit', 10, 0);
			$table->date('date_deposit');
			
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
		Schema::drop('z_deposit');
	}

}
