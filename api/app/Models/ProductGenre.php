<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductGenre extends Pivot
{
	use HasFactory;

	protected $table = 'products_genres';

	protected $fillable = [
		'product_id',
		'genre_id',
	];
}
