<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNumberunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('numberuns', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name_doc')->nullable();
            $table->dateTime('datetime_doc')->nullable();
            $table->string('number_doc')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('numberuns');
    }
}
