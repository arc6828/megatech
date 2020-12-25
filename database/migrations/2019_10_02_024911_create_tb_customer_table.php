<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbCustomerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_customer', function(Blueprint $table)
		{
			$table->integer('customer_id', true)->comment('id');
			$table->string('customer_code', 100)->nullable();
			$table->string('customer_type', 100)->nullable()->comment('ประเภทลูกหนี้');
			$table->string('company_name', 100)->nullable()->comment('ชื่อบริษัท');
			$table->integer('account_id')->nullable()->comment('รหัสผังบัญชี');
			$table->string('contact_name', 100)->nullable()->comment('ชื่อผู้ติดต่อ');
			$table->integer('customer_name')->nullable()->default(555);
			$table->text('address', 65535)->nullable()->comment('ที่อยู่');
			$table->text('address2', 65535)->nullable();
			$table->string('sub_district', 100)->nullable()->comment('ตำบล');
			$table->string('district', 100)->nullable()->comment('อำเภอ');
			$table->string('province', 100)->nullable()->comment('จังหวัด');
			$table->string('zipcode', 100)->nullable()->comment('รหัสไปรษณีย์');
			$table->text('delivery_address', 65535)->nullable()->comment('ที่อยู่ส่งของ');
			$table->text('delivery_address2', 65535)->nullable();
			$table->string('delivery_sub_district', 100)->nullable()->comment('ตำบล (ส่งของ)');
			$table->string('delivery_district', 100)->nullable()->comment('อำเภอ (ส่งของ)');
			$table->string('delivery_province', 100)->nullable()->comment('จังหวัด (ส่งของ)');
			$table->string('delivery_zipcode', 100)->nullable()->comment('รหัสไปรษณีย์ (ส่งของ)');
			$table->integer('user_id')->nullable()->default(1)->comment('รหัสพนักงานขาย');
			$table->string('telephone', 100)->nullable()->comment('เบอร์โทรศัพท์');
			$table->string('fax', 100)->nullable()->comment('เบอร์แฟ็กซ์');
			$table->string('email', 100)->nullable()->comment('อีเมล์');
			$table->integer('zone_id')->nullable()->comment('เขตการขาย');
			$table->integer('delivery_type_id')->nullable()->comment('ขนส่งโดย');
			$table->string('remark')->nullable()->comment('หมายเหตุ');
			$table->float('max_credit', 10, 0)->nullable()->comment('วงเงินเครดิต');
			$table->integer('debt_duration')->nullable()->comment('ระยะเวลาหนี้ (วัน)');
			$table->integer('degree_product')->nullable()->comment('ระดับของราคาสินค้า');
			$table->float('loyalty_discount', 10, 0)->nullable()->comment('ส่วนลดประจำ');
			$table->string('tax_number', 20)->nullable()->comment('เลขที่ภาษี');
			$table->string('billing_duration')->nullable()->comment('เงื่อนไขวางบิล');
			$table->string('cheqe_condition')->nullable()->comment('เงื่อนไขรับเช็ค');
			$table->string('delivery_time', 20)->nullable()->default('3')->comment('ระยะเวลาส่งของ');
			$table->string('payment_condition', 20)->nullable()->default('30')->comment('เงื่อนไขการชำระเงิน');
			$table->integer('tax_type_id')->nullable()->default(2)->comment('ชนิดภาษี');
			$table->integer('location_type_id')->nullable()->default(0)->comment('ชนิดสถานประกอบการ');
			$table->integer('branch_id')->nullable()->default(0)->comment('สำนักงาน/สาขา');
			$table->float('debt_balance', 10, 0)->nullable()->default(0)->comment('ยอดหนี้ขณะนี้');
			$table->text('upload', 65535)->nullable();
			$table->text('contact', 65535)->nullable();
			$table->string('payment_method', 191)->nullable();
			
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
		Schema::drop('tb_customer');
	}

}
