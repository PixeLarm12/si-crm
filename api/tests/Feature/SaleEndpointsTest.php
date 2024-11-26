<?php

namespace Tests\Feature;

use App\Enums\AbstractEnum;
use App\Enums\SaleEnum;
use App\Enums\UserEnum;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class SaleEndpointsTest extends TestCase
{
	private $baseUri = '/' . AbstractEnum::API_ROUTE_PREFIX . '/' . SaleEnum::ROUTE_PREFIX;

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
			'user_id'     => User::where('role', UserEnum::CLIENT)->first()->id,
			'total_price' => $faker->randomFloat(2, 0.5, 3000),
			'items'       => SaleItem::factory()->count(2)->make()->toArray(),
		];

		$response = $this->withHeaders([
			'Authorization' => 'Bearer ' . $this->getToken(),
		])->post($this->baseUri, $data);

		$response->assertStatus(Response::HTTP_CREATED);

		unset($data['items']);

		$this->assertDatabaseHas('sales', $data);
	}

	public function test_if_update_route_modifies_resource_successfully() : void
	{
		$faker = \Faker\Factory::create();

		$sale = Sale::factory()->create();

		$data = [
			'user_id'     => User::where('role', UserEnum::CLIENT)->first()->id,
			'total_price' => $faker->randomFloat(2, 0.5, 3000),
			'items'       => SaleItem::factory()->count(2)->make()->toArray(),
		];

		$response = $this->withHeaders([
			'Authorization' => 'Bearer ' . $this->getToken(),
		])->put("{$this->baseUri}/{$sale->id}", $data);

		$response->assertStatus(Response::HTTP_CREATED);

		unset($data['items']);

		$this->assertDatabaseHas('sales', $data);
	}

	public function test_if_delete_route_removes_resource_successfully() : void
	{
		$sale = Sale::factory()->create();

		$response = $this->withHeaders([
			'Authorization' => 'Bearer ' . $this->getToken(),
		])->delete("{$this->baseUri}/{$sale->id}");

		$response->assertStatus(Response::HTTP_NO_CONTENT);
		$this->assertDatabaseMissing('sales', ['id' => $sale->id]);
	}
}
