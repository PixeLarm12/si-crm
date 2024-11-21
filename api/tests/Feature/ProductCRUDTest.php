<?php

namespace Tests\Feature;

use App\Enums\AbstractEnum;
use App\Enums\ProductEnum;
use App\Models\Product;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ProductCRUDTest extends TestCase
{
	private $baseUri = '/' . AbstractEnum::API_ROUTE_PREFIX . '/' . ProductEnum::ROUTE_PREFIX;

	public function test_if_index_route_returns_successful() : void
	{
		$response = $this->get($this->baseUri);

		$response->assertStatus(Response::HTTP_OK);
	}

	public function test_if_store_route_creates_resource_successfully(): void
	{
		$faker = \Faker\Factory::create();

		$data = [
			"title" => $faker->sentence(2),
			"price" => $faker->randomFloat(2, 5, 100),
			"amount" => $faker->numberBetween(1, 100),
			"status" => $faker->randomElement([ProductEnum::STATUS_DRAFT, ProductEnum::STATUS_PUBLISHED])
		];

		$response = $this->post($this->baseUri, $data);

		$response->assertStatus(Response::HTTP_CREATED);

		$this->assertDatabaseHas('products', $data);
	}

	public function test_if_update_route_modifies_resource_successfully(): void
	{
		$faker = \Faker\Factory::create();

		$product = Product::factory()->create();

		$data = [
			"title" => $faker->sentence(2),
			"price" => $faker->randomFloat(2, 5, 100),
			"amount" => $faker->numberBetween(1, 100),
			"status" => $faker->randomElement([ProductEnum::STATUS_DRAFT, ProductEnum::STATUS_PUBLISHED])
		];

		$response = $this->put("{$this->baseUri}/{$product->id}", $data);

		$response->assertStatus(Response::HTTP_CREATED);
		
		$this->assertDatabaseHas('products', $data);
	}

	public function test_if_delete_route_removes_resource_successfully(): void
	{
		$product = Product::factory()->create();

		$response = $this->delete("{$this->baseUri}/{$product->id}");

		$response->assertStatus(Response::HTTP_NO_CONTENT);
		$this->assertSoftDeleted('products', ['id' => $product->id]);
	}

}