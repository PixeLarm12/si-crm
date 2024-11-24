<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
	use HasFactory;

	protected $table = 'genres';

	protected $fillable = [
		'title',
	];

	public function products()
	{
		return $this->belongsToMany(Product::class, 'products_genres', 'genre_id', 'product_id');
	}
}
