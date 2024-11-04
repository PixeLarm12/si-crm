<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Phone extends Model
{
	protected $table = 'phones';

	protected $fillable = [
		'phone',
		'user_id',
	];

	public function user() : BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
