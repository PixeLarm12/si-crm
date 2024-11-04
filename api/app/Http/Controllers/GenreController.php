<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenreRequest;
use App\Services\GenreService;

class GenreController extends BaseController
{
	public function __construct(GenreService $service)
	{
		parent::__construct($service);
	}

	public function index()
	{
		return $this->defaultResponse($this->service->getAllRecords());
	}

	public function store(GenreRequest $request)
	{
		return $this->defaultResponse($this->service->saveRecord($request->getData()));
	}

	public function show(string $id)
	{
		return $this->defaultResponse($this->service->findRecord($id));
	}

	public function update(GenreRequest $request, string $id)
	{
		return $this->defaultResponse($this->service->updateRecord($id, $request->getData()));
	}

	public function destroy(string $id)
	{
		return $this->defaultResponse($this->service->deleteRecord($id));
	}
}
