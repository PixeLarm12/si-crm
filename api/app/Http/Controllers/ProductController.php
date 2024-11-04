<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Services\ProductService;

class ProductController extends BaseController
{
	public function __construct(ProductService $service)
	{
		parent::__construct($service);
	}

	public function index()
	{
		return $this->defaultResponse($this->service->getAllRecords());
	}

	public function store(ProductRequest $request)
	{
		return $this->defaultResponse($this->service->saveRecord($request->getData()));
	}

	public function show(string $id)
	{
		return $this->defaultResponse($this->service->findRecord($id));
	}

	public function update(ProductRequest $request, string $id)
	{
		return $this->defaultResponse($this->service->updateRecord($id, $request->getData()));
	}

	public function destroy(string $id)
	{
		return $this->defaultResponse($this->service->deleteRecord($id));
	}
}
