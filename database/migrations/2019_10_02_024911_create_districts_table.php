<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDistrictsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('districts', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('district', 100);
			$table->string('amphoe', 100);
			$table->string('province', 100);
			$table->string('zipcode', 100);
			$table->string('district_code', 100);
			$table->string('amphoe_code', 100);
			$table->string('province_code', 100);
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
		Schema::drop('districts');
	}

}
