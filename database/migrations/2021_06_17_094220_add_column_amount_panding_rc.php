<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnAmountPandingRc extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('tb_purchase_order_detail', function (Blueprint $table) {
      $table->integer('amount_pending_rc')->nullable();
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
