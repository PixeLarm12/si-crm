<?php

namespace App\Services;

use App\Enums\NotificationEnum;
use App\Repositories\NotificationRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class NotificationService extends BaseService
{
	public function __construct(NotificationRepository $repository)
	{
		parent::__construct($repository);
	}

	public function checkNotification(string $id)
	{
		$notification = $this->findRecord($id);

		if (!$notification) {
			throw new ModelNotFoundException('Notification not found to recommend');
		}

		return $notification->update([
			'status' => NotificationEnum::STATUS_READ,
		]);
	}
}