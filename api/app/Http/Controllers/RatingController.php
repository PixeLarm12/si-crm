<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatingRequest;
use App\Services\RatingService;

class RatingController extends BaseController
{
    public function __construct(RatingService $service) 
    {
        parent::__construct($service);
    }
    
    public function index()
    {
        return $this->defaultResponse($this->service->getAllRecords());
    }

    public function store(RatingRequest $request)
    {
        return $this->defaultResponse($this->service->saveRecord($request->getData()));
    }

    public function show(string $id)
    {
        return $this->defaultResponse($this->service->findRecord($id));
    }

    public function update(RatingRequest $request, string $id)
    {
        return $this->defaultResponse($this->service->updateRecord($id, $request->getData()));
    }

    public function destroy(string $id)
    {
        return $this->defaultResponse($this->service->deleteRecord($id));
    }
}
