<?php

namespace App\Services;

use App\Repositories\SaleRepository;

class SaleService extends BaseService
{
    public function __construct(SaleRepository $repository) 
    {
        parent::__construct($repository);
    }
}