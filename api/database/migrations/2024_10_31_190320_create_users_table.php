<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('email', 40)->unique();
            $table->string('password', 60);
            $table->string('cpf', 11)->unique();
            $table->date('birth_date');
            $table->string('address', 120)->nullable();
            $table->string('address_number', 15)->nullable();
            $table->string('address_neighborhood', 120)->nullable();
            $table->string('address_complement', 120)->nullable();
            $table->string('address_zipcode', 8)->nullable();
            $table->integer('role')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
