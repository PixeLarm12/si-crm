<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
	public function up()
	{
		Schema::create('products', function (Blueprint $table) {
			$table->id();
			$table->string('title', 150);
			$table->decimal('price', 10, 2);
			$table->integer('amount')->default(0);
			$table->integer('status')->default(0);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::dropIfExists('products_genres');
		Schema::dropIfExists(table: 'products');
	}
};
