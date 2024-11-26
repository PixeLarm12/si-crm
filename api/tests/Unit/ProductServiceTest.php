<?php

namespace Tests\Unit;

use App\Enums\ProductEnum;
use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Services\ProductService;
use Tests\TestCase;

class ProductServiceTest extends TestCase
{
	public function test_product_find() : void
	{
		$product = Product::factory()->create();

		$service = new ProductService(new ProductRepository(new Product()));

		$this->assertInstanceOf(Product::class, $service->findRecord($product->id));
	}

	public function test_product_save() : void
	{
		$faker = \Faker\Factory::create();

		$data = [
			'title'  => $faker->sentence(2),
			'price'  => $faker->randomFloat(2, 0.5, 3000),
			'amount' => $faker->numberBetween(1, 100),
			'status' => $faker->randomElement([ProductEnum::STATUS_DRAFT, ProductEnum::STATUS_PUBLISHED]),
		];

		$service = new ProductService(new ProductRepository(new Product()));

		$this->assertInstanceOf(Product::class, $service->saveRecord($data));
	}

	public function test_product_update() : void
	{
		$faker = \Faker\Factory::create();

		$product = Product::factory()->create();

		$data = [
			'title'  => $faker->sentence(2),
			'price'  => $faker->randomFloat(2, 0.5, 3000),
			'amount' => $faker->numberBetween(1, 100),
			'status' => $faker->randomElement([ProductEnum::STATUS_DRAFT, ProductEnum::STATUS_PUBLISHED]),
		];

		$service = new ProductService(new ProductRepository(new Product()));

		$this->assertInstanceOf(Product::class, $service->updateRecord($product->id, $data));
	}

	public function test_product_delete() : void
	{
		$product = Product::factory()->create();

		$service = new ProductService(new ProductRepository(new Product()));

		$this->assertTrue($service->deleteRecord($product->id));
	}
}
