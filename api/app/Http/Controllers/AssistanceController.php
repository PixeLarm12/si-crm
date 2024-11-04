<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssistanceRequest;
use App\Services\AssistanceService;

class AssistanceController extends BaseController
{
    public function __construct(AssistanceService $service) 
    {
        parent::__construct($service);
    }
    
    public function index()
    {
        return $this->defaultResponse($this->service->getAllRecords());
    }

    public function store(AssistanceRequest $request)
    {
        return $this->defaultResponse($this->service->saveRecord($request->getData()));
    }

    public function show(string $id)
    {
        return $this->defaultResponse($this->service->findRecord($id));
    }

    public function update(AssistanceRequest $request, string $id)
    {
        return $this->defaultResponse($this->service->updateRecord($id, $request->getData()));
    }

    public function destroy(string $id)
    {
        return $this->defaultResponse($this->service->deleteRecord($id));
    }
}
