<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
	use HasFactory;

	protected $table = 'notifications';

	protected $fillable = [
		'user_id',
		'title',
		'message',
		'type',
		'date',
		'check_date',
		'status',
	];

	public function user() : BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
