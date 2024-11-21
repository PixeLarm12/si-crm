<?php

namespace Tests\Feature;

use App\Enums\AbstractEnum;
use App\Enums\SaleEnum;
use App\Enums\UserEnum;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class SaleCRUDTest extends TestCase
{
	private $baseUri = '/' . AbstractEnum::API_ROUTE_PREFIX . '/' . SaleEnum::ROUTE_PREFIX;

	public function test_if_index_route_returns_successful() : void
	{
		$response = $this->get($this->baseUri);

		$response->assertStatus(Response::HTTP_OK);
	}

	public function test_if_store_route_creates_resource_successfully(): void
	{
		$faker = \Faker\Factory::create();

		$data = [
			"user_id" => User::where('role', UserEnum::CLIENT)->first()->id,
			"total_price" => $faker->randomFloat(2, 20, 500),
			"items" => [
				[
					"product_id" => Product::first()->id,
					"amount" => $faker->numberBetween(1, 10),
					"unit_price" => $faker->randomFloat(2, 5, 100),
					"total_price" =>  function (array $attributes) {
						return $attributes['amount'] * $attributes['unit_price'];
					}
				],
				[
					"product_id" => Product::latest()->first()->id,
					"amount" => $faker->numberBetween(1, 10),
					"unit_price" => $faker->randomFloat(2, 5, 100),
					"total_price" =>  function (array $attributes) {
						return $attributes['amount'] * $attributes['unit_price'];
					}
				]
			]
		];

		$response = $this->post($this->baseUri, $data);

		$response->assertStatus(Response::HTTP_CREATED);
		
		unset($data['items']);

		$this->assertDatabaseHas('sales', $data);
	}

	public function test_if_update_route_modifies_resource_successfully(): void
	{
		$faker = \Faker\Factory::create();

		$sale = User::factory()->create();

		$data = [
			"user_id" => User::where('role', UserEnum::CLIENT)->first()->id,
			"total_price" => $faker->randomFloat(2, 20, 500),
			"items" => [
				[
					"product_id" => Product::first()->id,
					"amount" => $faker->numberBetween(1, 10),
					"unit_price" => $faker->randomFloat(2, 5, 100),
					"total_price" =>  function (array $attributes) {
						return $attributes['amount'] * $attributes['unit_price'];
					}
				],
				[
					"product_id" => Product::latest()->first()->id,
					"amount" => $faker->numberBetween(1, 10),
					"unit_price" => $faker->randomFloat(2, 5, 100),
					"total_price" =>  function (array $attributes) {
						return $attributes['amount'] * $attributes['unit_price'];
					}
				]
			]
		];

		$response = $this->put("{$this->baseUri}/{$sale->id}", $data);

		$response->assertStatus(Response::HTTP_CREATED);
		
		unset($data['items']);

		$this->assertDatabaseHas('sales', $data);
	}

	public function test_if_delete_route_removes_resource_successfully(): void
	{
		$sale = Sale::factory()->create();

		$response = $this->delete("{$this->baseUri}/{$sale->id}");

		$response->assertStatus(Response::HTTP_NO_CONTENT);
		$this->assertDatabaseMissing('sales', ['id' => $sale->id]);
	}

}
