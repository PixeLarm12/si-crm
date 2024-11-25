<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
	use HasFactory;

	protected $table = 'sales';

	protected $fillable = [
		'user_id',
		'total_price',
		'date',
	];

	protected $hidden = [
		'created_at',
		'updated_at',
		'deleted_at',
	];

	protected static function boot()
	{
		parent::boot();

		static::deleting(function ($sale) {
			$sale->items()->delete();
		});
	}

	public function items() : HasMany
	{
		return $this->hasMany(SaleItem::class);
	}
}
