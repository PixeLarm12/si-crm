<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductGenre extends Pivot
{
	protected $table = 'products_genres';
}
