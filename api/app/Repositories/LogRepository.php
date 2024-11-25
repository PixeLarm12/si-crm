<?php

namespace App\Repositories;

use App\Models\Log;

class LogRepository extends BaseRepository
{
	public function __construct(Log $model)
	{
		parent::__construct($model);
	}

	public function all() : \Illuminate\Support\Collection
	{
		return $this->model->filter(request()->only('search', 'user_id'))->get();
	}
}
