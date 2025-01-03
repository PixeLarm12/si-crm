<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

	protected $hidden = [
		'created_at',
		'updated_at',
		'deleted_at',
	];

	public function genres()
	{
		return $this->belongsToMany(Genre::class, 'products_genres', 'product_id', 'genre_id');
	}

	public function scopeFilter($query, array $filters)
	{
		$query->when($filters['search'] ?? null, function ($query, $search) {
			$query->where(function ($query) use ($search) {
				$query->where('title', 'like', '%' . $search . '%');
			});
		});
	}
}
