<?php

namespace App\Services;

use App\Repositories\PhoneRepository;

class PhoneService extends BaseService
{
	public function __construct(PhoneRepository $repository)
	{
		parent::__construct($repository);
	}
}