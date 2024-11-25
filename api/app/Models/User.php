<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
	use Notifiable;
	use SoftDeletes;
	use HasFactory;

	protected $table = 'users';

	protected $fillable = [
		'name',
		'email',
		'password',
		'cpf',
		'birth_date',
		'address',
		'address_number',
		'address_neighborhood',
		'address_complement',
		'address_zipcode',
		'role',
	];

	protected $hidden = [
		'password',
	];

	protected function casts() : array
	{
		return [
			'password' => 'hashed',
		];
	}

	public function getJWTIdentifier()
	{
		return $this->getKey();
	}

	public function getJWTCustomClaims()
	{
		return [];
	}

	public function ratings() : HasMany
	{
		return $this->hasMany(Rating::class);
	}

	public function openedAssistances() : HasMany
	{
		return $this->hasMany(Assistance::class, 'opened_by');
	}

	public function relatedAssistances() : HasMany
	{
		return $this->hasMany(Assistance::class, 'admin_id');
	}

	public function sales() : HasMany
	{
		return $this->hasMany(Sale::class);
	}

	public function phones() : HasMany
	{
		return $this->hasMany(Phone::class);
	}

	public function notifications() : HasMany
	{
		return $this->hasMany(Notification::class);
	}
}
