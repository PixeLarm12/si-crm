<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Phone extends Model
{
	use HasFactory;

	protected $table = 'phones';

	protected $fillable = [
		'phone',
		'user_id',
	];

	protected $hidden = [
		'created_at',
		'updated_at',
		'deleted_at',
	];

	public function user() : BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
