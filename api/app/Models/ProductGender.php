<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductGender extends Model
{
    protected $table = 'products_genres';

    protected $fillable = [
        'product_id',
        'genre_id',
    ];
}
