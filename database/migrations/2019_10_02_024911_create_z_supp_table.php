<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZSuppTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('z_supp', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('code', 100);
			$table->string('company', 190);
			$table->text('address1', 65535);
			$table->text('address2', 65535);
			$table->string('TEL', 100);
			$table->string('FAX', 100);
			$table->string('tax', 20);
			
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
		Schema::drop('z_supp');
	}

}
