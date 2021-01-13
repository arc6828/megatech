<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbInvoiceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_invoice', function(Blueprint $table)
		{
			$table->integer('invoice_id', true)->comment('id');
			$table->string('invoice_code', 20)->nullable()->comment('เลขที่ใบเสนอราคา');
			$table->timestamp('datetime')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'))->comment('วันที่เวลา');
			$table->integer('customer_id')->comment('รหัสลูกค้า');
			$table->integer('debt_duration')->comment('ระยะเวลาหนี้ (วัน)');
			$table->integer('billing_duration')->comment('กำหนดยื่นราคา (วัน)');
			$table->string('payment_condition')->nullable()->comment('เงื่อนไขการชำระเงิน');
			$table->integer('delivery_type_id')->comment('ขนส่งโดย');
			$table->integer('tax_type_id')->comment('ชนิดภาษี');
			$table->integer('delivery_time')->comment('ระยะเวลาในกาส่งของ (วัน)');
			$table->string('department_id', 11)->nullable()->comment('รหัสแผนก');
			$table->integer('sales_status_id')->comment('สถานะ');
			$table->integer('user_id')->comment('รหัสพนักงานขาย');
			$table->integer('zone_id')->comment('เขตการขาย');
			$table->string('remark')->nullable()->comment('หมายเหตุ');
			$table->float('vat_percent', 10, 0)->nullable()->default(7)->comment('อัตราภาษี %');
			$table->string('external_reference_id', 100)->nullable();
			$table->string('internal_reference_id', 100)->nullable();
			$table->float('total', 10, 0)->nullable()->default(0);
			
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
		Schema::drop('tb_invoice');
	}

}
