<?php

namespace App\Services;

use App\Repositories\AssistanceRepository;

class AssistanceService extends BaseService
{
    public function __construct(AssistanceRepository $repository) 
    {
        parent::__construct($repository);
    }
}