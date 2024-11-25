<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Services\AuthService;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends BaseController
{
	public function __construct(AuthService $service)
	{
		parent::__construct($service);
	}

	public function login(AuthRequest $request)
	{
		return $this->defaultResponse($this->service->login($request->getData()), Response::HTTP_FOUND);
	}

    public function logout()
	{
		return $this->defaultResponse([], Response::HTTP_OK);
	}
}
