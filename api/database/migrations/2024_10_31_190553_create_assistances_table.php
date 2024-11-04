<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
	public function up()
	{
		Schema::create('assistances', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('opened_by');
			$table->unsignedBigInteger('admin_id');
			$table->integer('type');
			$table->string('subject', 50);
			$table->string('message', 255);
			$table->dateTime('open_date');
			$table->dateTime('close_date')->nullable();
			$table->integer('status')->default(0);
			$table->timestamps();

			$table->foreign('opened_by')->references('id')->on('users');
			$table->foreign('admin_id')->references('id')->on('users');
		});
	}

	public function down()
	{
		Schema::dropIfExists('assistances');
	}
};
