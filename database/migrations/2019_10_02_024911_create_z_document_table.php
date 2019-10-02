<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZDocumentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('z_document', function(Blueprint $table)
		{
			$table->integer('id_document')->primary();
			$table->text('no_document', 65535)->nullable();
			$table->integer('id_department');
			$table->text('tax_liability', 65535)->nullable();
			$table->text('type_text', 65535)->nullable();
			$table->text('id_customer', 65535);
			$table->integer('id_account');
			$table->integer('balance');
			$table->integer('id_job');
			$table->integer('id_deposit');
			
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
		Schema::drop('z_document');
	}

}
