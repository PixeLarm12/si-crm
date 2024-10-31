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
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('genres_id');
            $table->timestamps();

            $table->foreign(columns: 'product_id')->references('id')->on('products');
            $table->foreign('genre_id')->references('id')->on('genres');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products_genres');
    }
};
