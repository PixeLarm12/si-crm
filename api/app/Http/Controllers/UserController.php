<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Imports\LeadsImport;
use App\Services\UserService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

class UserController extends BaseController
{
	public function __construct(UserService $service)
	{
		parent::__construct($service);
	}

	public function index()
	{
		return $this->defaultResponse($this->service->getAllRecords());
	}

	public function store(UserRequest $request)
	{
		return $this->defaultResponse($this->service->saveRecord($request->getData()), Response::HTTP_CREATED);
	}

	public function show(string $id)
	{
		return $this->defaultResponse($this->service->findRecord($id));
	}

	public function update(UserRequest $request, string $id)
	{
		return $this->defaultResponse($this->service->updateRecord($id, $request->getData()), Response::HTTP_CREATED);
	}

	public function destroy(string $id)
	{
		return $this->defaultResponse($this->service->deleteRecord($id), Response::HTTP_NO_CONTENT);
	}
	
	public function importLeads(Request $request)
	{
		Excel::import(new LeadsImport, $request->file('leads'));

		return $this->defaultResponse([], Response::HTTP_CREATED);
	}
}
