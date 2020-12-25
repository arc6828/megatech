<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetDefaultValueToTbSupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_supplier', function (Blueprint $table) {
            $table->integer('user_id')->nullable()->default(1)->change();            
            $table->integer('zone_id')->nullable()->default(1)->change();       
            $table->integer('delIvery_type_id')->nullable()->default(1)->change();       
            $table->float('max_credit',16,2)->nullable()->default(100000)->change();       
            $table->integer('debt_duration')->nullable()->default(30)->change();         
            $table->integer('tax_type_id')->nullable()->default(2)->change();          
            $table->integer('location_type_id')->nullable()->default(1)->change();       
            $table->string('branch_id')->nullable()->default("1")->change();       
            $table->string('payment_method')->nullable()->default("credit")->change();       
            $table->float('debt_balance',16,2)->nullable()->default(0)->change();       
            $table->string('billing_cycle_date')->nullable()->default(1);      
            $table->string('billing_method')->nullable()->default("drive");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_supplier', function (Blueprint $table) {
            //
        });
    }
}
