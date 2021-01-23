<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFileToCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_customer', function (Blueprint $table) {
            Schema::table('tb_customer', function (Blueprint $table) {
                $table->string('file_map')->nullable();
                $table->string('file_cc')->nullable();
                $table->string('file_cv_20')->nullable();
                $table->string('file_cheque')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
