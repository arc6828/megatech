<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnRequisitionDetail extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('tb_purchase_requisition_detail', function (Blueprint $table) {
      $table->integer('approved_amount')->nullable();
      $table->integer('before_approved_amount')->nullable();
      $table->integer('supplier_amount')->nullable();
      $table->integer('po_amount')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('tb_purchase_requisition_detail', function (Blueprint $table) {
      //
    });
  }
}
