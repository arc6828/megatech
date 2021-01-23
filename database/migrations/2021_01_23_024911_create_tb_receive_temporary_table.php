<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbReceiveTemporaryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_receive_temporary', function(Blueprint $table)
		{
			$table->integer('receive_temporary_id', true)->comment('id');
			$table->string('receive_temporary_code', 20)->nullable()->comment('เลขที่เอกสาร');
			$table->timestamp('datetime')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'))->comment('วันที่เวลา');
			$table->integer('supplier_id')->comment('รหัสเจ้าหนี้');
			$table->text('contact_name', 65535)->nullable();
			$table->integer('debt_duration')->comment('ระยะเวลาหนี้ (วัน)');
			$table->integer('billing_duration')->comment('กำหนดยื่นราคา (วัน)');
			$table->string('payment_condition')->nullable()->comment('เงื่อนไขการชำระเงิน');
			$table->integer('receive_type_id')->comment('ขนส่งโดย');
			$table->integer('tax_type_id')->comment('ชนิดภาษี');
			$table->integer('receive_time')->comment('ระยะเวลาในกาส่งของ (วัน)');
			$table->string('department_id', 11)->nullable()->comment('รหัสแผนก');
			$table->integer('purchase_status_id')->comment('สถานะ');
			$table->integer('user_id')->comment('รหัสพนักงานขาย');
			$table->integer('zone_id')->comment('เขตการขาย');
			$table->string('remark')->nullable()->comment('หมายเหตุ');
			$table->float('vat_percent', 10, 0)->nullable()->default(7)->comment('อัตราภาษี %');
			$table->string('internal_reference_doc', 100)->nullable();
			$table->string('external_reference_doc', 100)->nullable();
			$table->float('total', 10, 0)->nullable()->default(0)->comment('ราคารวม');
			
			$table->timestamps();
			$table->integer('revision' )->nullable()->default(0) ;
			$table->integer('staff_id' )->nullable() ;
			
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tb_receive_temporary');
	}

}
