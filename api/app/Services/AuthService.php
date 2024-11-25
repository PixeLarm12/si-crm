<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

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
		if (!$token = JWTAuth::attempt($credentials)) {
            throw new BadRequestException('User credentials do not match');
        }

		$user = auth()->user();

		return JWTAuth::claims(['role' => $user->role])->fromUser($user);
	}

    public function logout() : bool
	{
		JWTAuth::invalidate(JWTAuth::getToken());

        return true;
	}

	public function getUser(): mixed
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'User not found'], 404);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Invalid token'], 400);
        }

        return $user;
    }
}