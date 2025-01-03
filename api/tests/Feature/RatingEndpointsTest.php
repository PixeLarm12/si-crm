<?php

namespace Tests\Feature;

use App\Enums\AbstractEnum;
use App\Enums\RatingEnum;
use App\Enums\UserEnum;
use App\Models\Product;
use App\Models\Rating;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class RatingEndpointsTest extends TestCase
{
	private $baseUri = '/' . AbstractEnum::API_ROUTE_PREFIX . '/' . RatingEnum::ROUTE_PREFIX;

	public function getToken()
	{
		$admin = User::factory()->create([
			'role' => UserEnum::ADMIN,
		]);

		return JWTAuth::claims(['role' => $admin->role])->fromUser($admin);
	}

	public function test_if_index_route_returns_successful() : void
	{
		$response = $this->withHeaders([
			'Authorization' => 'Bearer ' . $this->getToken(),
		])->get($this->baseUri);

		$response->assertStatus(Response::HTTP_OK);
	}

	public function test_if_store_route_creates_resource_successfully() : void
	{
		$faker = \Faker\Factory::create();

		$data = [
			'user_id'    => User::where('role', UserEnum::CLIENT)->first()->id,
			'product_id' => Product::first()->id,
			'rate'       => $faker->randomFloat(1, 1, 5),
		];

		$response = $this->withHeaders([
			'Authorization' => 'Bearer ' . $this->getToken(),
		])->post($this->baseUri, $data);

		$response->assertStatus(Response::HTTP_CREATED);

		$this->assertDatabaseHas('ratings', $data);
	}

	public function test_if_update_route_modifies_resource_successfully() : void
	{
		$faker = \Faker\Factory::create();

		$rating = Rating::factory()->create();

		$data = [
			'user_id'    => $rating->user->id,
			'product_id' => $rating->product->id,
			'rate'       => $faker->randomFloat(1, 1, 5),
		];

		$response = $this->withHeaders([
			'Authorization' => 'Bearer ' . $this->getToken(),
		])->put("{$this->baseUri}/{$rating->id}", $data);

		$response->assertStatus(Response::HTTP_CREATED);

		$this->assertDatabaseHas('ratings', $data);
	}

	public function test_if_delete_route_removes_resource_successfully() : void
	{
		$rating = Rating::factory()->create();

		$response = $this->withHeaders([
			'Authorization' => 'Bearer ' . $this->getToken(),
		])->delete("{$this->baseUri}/{$rating->id}");

		$response->assertStatus(Response::HTTP_NO_CONTENT);
		$this->assertDatabaseMissing('ratings', ['id' => $rating->id]);
	}
}
