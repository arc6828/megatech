<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePurchaseOrderDetail extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('tb_purchase_order_detail', function (Blueprint $table) {
      $table->integer("purchase_order_id")->nullable()->change();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('tb_purchase_order_detail', function (Blueprint $table) {
      //
    });
  }
}
