<?php

namespace App\Services;

use App\Repositories\LogRepository;

class LogService extends BaseService
{
    public function __construct(LogRepository $repository)
    {
        parent::__construct($repository);
    }

    public function getAllRecords(): \Illuminate\Support\Collection
    {
        return $this->repository->all();
    }
}
