<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\RatingRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RatingService extends BaseService
{
	/**
	 * @var RecommendationService
	 */
	protected RecommendationService $recommendationService;

	/**
	 * @var UserService
	 */
	protected UserService $userService;
	
	public function __construct(RatingRepository $repository)
	{
		parent::__construct($repository);

		$this->recommendationService = new RecommendationService();
		$this->userService = new UserService(new UserRepository(new User()));
	}

	public function recommend(string $id)
	{
		$user = $this->userService->findRecord($id);

		if(!$user) {
			throw new ModelNotFoundException('User not found to recommend');
		}

		$ratings = $user->ratings->toArray();

		if(count($ratings) > 0) {
			$this->recommendationService->recommendForUser($ratings);
		}
	}
}