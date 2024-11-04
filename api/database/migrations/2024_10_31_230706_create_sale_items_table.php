<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
	public function up()
	{
		Schema::create('sale_items', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('sale_id');
			$table->unsignedBigInteger('product_id');
			$table->integer('amount')->default(1);
			$table->decimal('unit_price', 10, 2);
			$table->decimal('total_price', 10, 2);
			$table->timestamps();

			$table->foreign('sale_id')->references('id')->on('sales');
			$table->foreign('product_id')->references('id')->on('products');
		});
	}

	public function down()
	{
		Schema::dropIfExists('sale_items');
	}
};
