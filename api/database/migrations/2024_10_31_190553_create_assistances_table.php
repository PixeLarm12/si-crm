<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('assistances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('opened_by')->constrained('users');
            $table->foreignId('admin_id')->constrained('users');
            $table->integer('type');
            $table->string('subject', 50);
            $table->string('message', 255);
            $table->dateTime('open_date');
            $table->dateTime('close_date')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('assistances');
    }
};
