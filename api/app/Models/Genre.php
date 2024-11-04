<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Genre extends Model
{
	protected $table = 'genres';

	protected $fillable = [
		'title',
	];

	public function genres() : HasMany
	{
		return $this->hasMany(Product::class, ProductGenre::class, 'genre_id');
	}
}
