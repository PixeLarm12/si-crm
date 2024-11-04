<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
	public function up()
	{
		Schema::create('phones', function (Blueprint $table) {
			$table->id();
			$table->string('phone', 15);
			$table->unsignedBigInteger('user_id');
			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users');
		});
	}

	public function down()
	{
		Schema::dropIfExists('phones');
	}
};
