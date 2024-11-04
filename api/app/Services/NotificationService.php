<?php

namespace App\Services;

use App\Repositories\NotificationRepository;

class NotificationService extends BaseService
{
	public function __construct(NotificationRepository $repository)
	{
		parent::__construct($repository);
	}
}