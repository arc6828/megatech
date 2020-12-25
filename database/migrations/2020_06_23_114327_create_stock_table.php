<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('product_id');
            $table->timestamps();
			$table->string('product_code', 30)->nullable();
			$table->string('product_name', 150)->nullable();
			$table->string('product_detail', 150)->nullable();
			$table->string('brand', 150)->nullable();
			$table->string('grade', 100)->nullable();
			$table->float('promotion_price', 16, 0)->nullable();
			$table->float('floor_price', 16, 0)->nullable();
			$table->float('max_discount_percent', 10, 0)->nullable()->default(40);
			$table->integer('amount_in_stock')->nullable()->default(0);
			$table->string('product_unit', 10)->nullable()->default("pcs");
			$table->integer('pending_in')->nullable()->default(0)->comment('ค้างรับ');
			$table->integer('pending_out')->nullable()->default(0)->comment('ค้างส่ง');
			$table->float('normal_price', 16, 4)->nullable()->default(0.0000);
			$table->string('BARCODE', 20)->nullable();
			$table->string('item_code', 20)->nullable();
			$table->float('purchase_price', 10, 0)->nullable()->default(0);
			$table->string('purchase_ref', 100)->nullable()->comment('อ้างอิงการซื้อ');
			$table->string('ISBN', 100)->nullable();
			$table->integer('quantity')->nullable()->default(1);
			$table->float('weight_in_lbs', 10, 0)->nullable()->default(0);
			$table->float('price_1', 10, 0)->nullable()->default(0);
			$table->float('price_10_99', 10, 0)->nullable()->default(0);
			$table->float('price_100', 10, 0)->nullable()->default(0);
			$table->string('stock', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
