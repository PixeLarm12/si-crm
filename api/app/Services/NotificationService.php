<?php

namespace App\Services;

use App\Enums\NotificationEnum;
use App\Models\Notification;
use App\Repositories\NotificationRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class NotificationService extends BaseService
{
	public function __construct()
	{
		parent::__construct(new NotificationRepository(new Notification()));
	}

	public function checkNotification(string $id)
	{
		$notification = $this->findRecord($id);

		if (!$notification) {
			throw new ModelNotFoundException('Notification not found to recommend');
		}

		return $notification->update([
			'status'     => NotificationEnum::STATUS_READ,
			'check_date' => Carbon::now(),
		]);
	}

	public function setNotification(string $userId, string $type)
	{
		if ($type == NotificationEnum::TYPE_PURCHASE) {
			$this->saveRecord([
				'user_id' => $userId,
				'title'   => NotificationEnum::TITLE_NEW_PURCHASE,
				'message' => NotificationEnum::MESSAGE_PURCHASE,
				'type'    => NotificationEnum::TYPE_PURCHASE,
				'date'    => Carbon::now(),
				'status'  => NotificationEnum::STATUS_UNREAD,
			]);
		}

		if ($type == NotificationEnum::TYPE_RECOMMENDATION) {
			$this->saveRecord([
				'user_id' => $userId,
				'title'   => NotificationEnum::TITLE_NEW_RECOMMENDATION,
				'message' => NotificationEnum::MESSAGE_RECOMMENDATION,
				'type'    => NotificationEnum::TYPE_RECOMMENDATION,
				'date'    => Carbon::now(),
				'status'  => NotificationEnum::STATUS_UNREAD,
			]);
		}

		if ($type == NotificationEnum::TYPE_PROBLEM) {
			$this->saveRecord([
				'user_id' => $userId,
				'title'   => NotificationEnum::TITLE_NEW_PROBLEM,
				'message' => NotificationEnum::MESSAGE_PROBLEM,
				'type'    => NotificationEnum::TYPE_PROBLEM,
				'date'    => Carbon::now(),
				'status'  => NotificationEnum::STATUS_UNREAD,
			]);
		}
	}
}