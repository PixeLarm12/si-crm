<?php

namespace App\Services;

use App\Models\Product;
use App\Models\User;
use App\Repositories\ProductRepository;
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

	/**
	 * @var ProductService
	 */
	protected ProductService $productService;
	
	public function __construct(RatingRepository $repository)
	{
		parent::__construct($repository);

		$this->recommendationService = new RecommendationService();
		$this->userService = new UserService(new UserRepository(new User()));
		$this->productService = new ProductService(new ProductRepository(new Product()));
	}

	public function recommend(string $id)
	{
		$user = $this->userService->findRecord($id);

		if(!$user) {
			throw new ModelNotFoundException('User not found to recommend');
		}

		$ratings = $user->ratings->toArray();

		if(count($ratings) > 0) {
			$dataToRecommend = [];

			foreach($ratings as $rating) {
				$product = $this->productService->findRecord($rating["product_id"]);

				array_push($dataToRecommend, [
					$product->title,
					$product->genres->first()->title ?? 'no-genre-provided',
					(float) $rating['rate']
				]);
			}

			array_unshift($dataToRecommend, [
				"Title",
				"Genre",
				"Rating",
			]);
		}

		return $this->recommendationService->recommendForUser($dataToRecommend);
	}
}