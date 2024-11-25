<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends BaseRepository
{
	public function __construct(Product $model)
	{
		parent::__construct($model);
	}

	public function all() : \Illuminate\Support\Collection
	{
		return $this->model->with('genres')->filter(request()->only('search'))->get();
	}
}
