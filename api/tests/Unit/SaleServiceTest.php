<?php

namespace Tests\Unit;

use App\Enums\UserEnum;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\User;
use App\Repositories\SaleRepository;
use App\Services\SaleService;
use Carbon\Carbon;
use Tests\TestCase;

class SaleServiceTest extends TestCase
{
	public function test_sale_find() : void
	{
		$sale = Sale::factory()->create();

		$service = new SaleService(new SaleRepository(new Sale()));

		$this->assertInstanceOf(Sale::class, $service->findRecord($sale->id));
	}

	public function test_sale_save() : void
	{
		$faker = \Faker\Factory::create();

		$data = [
			'user_id'     => User::where('role', UserEnum::CLIENT)->first()->id,
			'total_price' => $faker->randomFloat(2, 0.5, 3000),
			'items'       => SaleItem::factory()->count(2)->make()->toArray(),
			'date'        => Carbon::now(),
		];

		$service = new SaleService(new SaleRepository(new Sale()));

		$this->assertInstanceOf(Sale::class, $service->saveRecord($data));
	}

	public function test_sale_update() : void
	{
		$faker = \Faker\Factory::create();

		$sale = User::factory()->create();

		$data = [
			'user_id'     => User::where('role', UserEnum::CLIENT)->first()->id,
			'total_price' => $faker->randomFloat(2, 0.5, 3000),
			'items'       => SaleItem::factory()->count(2)->make()->toArray(),
		];

		$service = new SaleService(new SaleRepository(new Sale()));

		$this->assertInstanceOf(Sale::class, $service->updateRecord($sale->id, $data));
	}

	public function test_sale_delete() : void
	{
		$sale = Sale::factory()->create();

		$service = new SaleService(new SaleRepository(new Sale()));

		$this->assertTrue($service->deleteRecord($sale->id));
	}
}
