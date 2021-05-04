<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('thname_company')->nullable();
            $table->string('enname_company')->nullable();
            $table->text('address')->nullable();
            $table->integer('tal')->nullable();
            $table->integer('fax')->nullable();
            $table->integer('number_tex')->nullable();
            $table->string('image')->nullable();
            $table->string('email')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('companies');
    }
}
