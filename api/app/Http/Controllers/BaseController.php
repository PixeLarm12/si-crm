<?php

namespace App\Http\Controllers;

use App\Services\BaseService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseController
{
	protected BaseService $service;

	/**
	 * @param BaseService $service
	 */
	public function __construct(BaseService $service)
	{
		$this->service = $service;
	}

	protected function defaultResponse($data, $code = Response::HTTP_OK) : JsonResponse
	{
		return response()->json($data, $code);
	}
}
