<?php

namespace App\Services;

use App\Enums\AIModelEnum;
use App\Enums\NotificationEnum;

class RecommendationService
{
	/**
	 * @var string
	 */
	protected string $url = AIModelEnum::PROD_URL;

	public function __construct()
	{
		if ($_ENV['AI_ENV'] == 'local') {
			$this->url = AIModelEnum::LOCAL_URL;
		}
	}

	public function recommendForUser(array $data, int $userId)
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $this->url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Content-Type: application/json',
			'Accept: application/json',
		]);

		$response = curl_exec($ch);

		if ($error = curl_error($ch)) {
			curl_close($ch);

			return 'Error:' . $error;
		}

		curl_close($ch);

		$notificationService = new NotificationService();
		$notificationService->setNotification($userId, NotificationEnum::TYPE_RECOMMENDATION);

		return json_decode($response, true);
	}
}