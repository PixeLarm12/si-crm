<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductGenre extends Model
{
    protected $table = 'products_genres';

    protected $fillable = [
        'product_id',
        'genre_id',
    ];
}
