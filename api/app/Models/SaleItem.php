<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaleItem extends Model
{
	use HasFactory;

	protected $table = 'sale_items';

	protected $fillable = [
		'sale_id',
		'product_id',
		'amount',
		'unit_price',
		'total_price',
	];

	protected $hidden = [
		'created_at',
		'updated_at',
		'deleted_at',
	];

	public function sale() : BelongsTo
	{
		return $this->belongsTo(Sale::class);
	}
}
