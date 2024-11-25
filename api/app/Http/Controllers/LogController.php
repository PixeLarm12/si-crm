<?php

namespace App\Http\Controllers;

use App\Services\LogService;
use Illuminate\Http\Request;

class LogController extends BaseController
{
    public function __construct(LogService $service)
    {
        parent::__construct($service);
    }

    public function index()
    {
        return $this->defaultResponse($this->service->getAllRecords());
    }
}
