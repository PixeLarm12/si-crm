<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class AuthService extends BaseService
{
	public function __construct(UserRepository $repository)
	{
		parent::__construct($repository);
	}

	/**
	 * Login user and return jwt token
	 *
	 * @param array $data
	 * @return Model
	 */
	public function login(array $credentials) : string
	{
		if (!$token = auth('api')->attempt($credentials)) {
            throw new BadRequestException('User credentials do not match');
        }

		return $token;
	}

    public function logout() : bool
	{
		return (bool) auth('api')->logout();
	}
}