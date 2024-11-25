<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService extends BaseService
{
	public function __construct(ProductRepository $repository)
	{
		parent::__construct($repository);
	}

    public function getAllRecords(): \Illuminate\Support\Collection
    {
        return $this->repository->all();
    }
}
