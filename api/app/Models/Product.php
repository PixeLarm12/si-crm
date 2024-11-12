<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
	use HasFactory;
	
	use SoftDeletes;

	protected $table = 'products';

	protected $fillable = [
		'title',
		'price',
		'amount',
		'status',
	];

	public function genres() : HasMany
	{
		return $this->hasMany(Genre::class, ProductGenre::class, 'product_id');
	}
}
