<?php

namespace App\Services;

use App\Enums\AIModelEnum;

class RecommendationService
{
    /**
     * @var string
     */
    protected string $url = AIModelEnum::PROD_URL;

	public function __construct()
	{
        if($_ENV['AI_ENV'] == 'local') {
            $this->url = AIModelEnum::LOCAL_URL;
        }
	}

	public function recommendForUser(array $ratings)
	{
		dd($ratings);
	}
}