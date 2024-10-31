<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products_genres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('genres_id')->constrained('genres');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products_genres');
    }
};
