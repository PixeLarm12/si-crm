<?php

namespace Tests\Unit;

use App\Enums\UserEnum;
use App\Models\Product;
use App\Models\Rating;
use App\Models\User;
use App\Repositories\RatingRepository;
use App\Services\RatingService;
use Carbon\Carbon;
use Tests\TestCase;

class RatingServiceTest extends TestCase
{
	public function test_rating_find() : void
	{
		$rating = Rating::factory()->create();

		$service = new RatingService(new RatingRepository(new Rating()));

		$this->assertInstanceOf(Rating::class, $service->findRecord($rating->id));
	}

	public function test_rating_save() : void
	{
		$faker = \Faker\Factory::create();

		$data = [
			'user_id'    => User::where('role', UserEnum::CLIENT)->first()->id,
			'product_id' => Product::first()->id,
			'rate'       => $faker->randomFloat(1, 1, 5),
			'date'       => Carbon::now(),
		];

		$service = new RatingService(new RatingRepository(new Rating()));

		$this->assertInstanceOf(Rating::class, $service->saveRecord($data));
	}

	public function test_rating_update() : void
	{
		$faker = \Faker\Factory::create();

		$rating = Rating::factory()->create();

		$data = [
			'user_id'    => $rating->user->id,
			'product_id' => $rating->product->id,
			'rate'       => $faker->randomFloat(1, 1, 5),
		];

		$service = new RatingService(new RatingRepository(new Rating()));

		$this->assertInstanceOf(Rating::class, $service->updateRecord($rating->id, $data));
	}

	public function test_rating_delete() : void
	{
		$rating = Rating::factory()->create();

		$service = new RatingService(new RatingRepository(new Rating()));

		$this->assertTrue($service->deleteRecord($rating->id));
	}
}
