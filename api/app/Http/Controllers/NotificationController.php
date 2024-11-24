<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationRequest;
use App\Services\NotificationService;
use Symfony\Component\HttpFoundation\Response;

class NotificationController extends BaseController
{
	public function __construct(NotificationService $service)
	{
		parent::__construct($service);
	}

	public function index()
	{
		return $this->defaultResponse($this->service->getAllRecords());
	}

	public function store(NotificationRequest $request)
	{
		return $this->defaultResponse($this->service->saveRecord($request->getData()), Response::HTTP_CREATED);
	}

	public function show(string $id)
	{
		return $this->defaultResponse($this->service->findRecord($id));
	}

	public function update(NotificationRequest $request, string $id)
	{
		return $this->defaultResponse($this->service->updateRecord($id, $request->getData()), Response::HTTP_CREATED);
	}

	public function destroy(string $id)
	{
		return $this->defaultResponse($this->service->deleteRecord($id), Response::HTTP_NO_CONTENT);
	}
}
