<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up() : void
	{
		Schema::create('logs', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('user_id')->nullable();
			$table->string('action');
			$table->string('model');
			$table->integer('model_id')->nullable();
			$table->json('data')->nullable();
			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down() : void
	{
		Schema::dropIfExists('logs');
	}
};
