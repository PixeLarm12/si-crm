<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
	public function up()
	{
		Schema::create('ratings', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('user_id');
			$table->unsignedBigInteger(column: 'product_id');
			$table->decimal('rate', 2, 1);
			$table->dateTime('date');
			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('product_id')->references('id')->on('products');
		});
	}

	public function down()
	{
		Schema::dropIfExists('ratings');
	}
};
