<?php

namespace Tests\Feature;

use App\Enums\AbstractEnum;
use App\Enums\UserEnum;
use Tests\TestCase;

class UserRoutesTest extends TestCase
{
	private $baseUri = '/' . AbstractEnum::API_ROUTE_PREFIX . '/' . UserEnum::ROUTE_PREFIX;

	// public function test_if_index_route_returns_successful() : void
	// {
	// 	$response = $this->get($this->baseUri);

	// 	$response->assertStatus(200);
	// }

	public function test_if_store_route_creates_resource_successfully(): void
	{
		$data = [
			"name" => "PHPUnit User",
			"email" => "phpunit_user@example.com",
			"password" => "strongpass123!",
			"password_confirmation" => "strongpass123!",
			"cpf" => "12345678901",
			"birth_date" => "1990-05-15",
			"address" => "Flower's street",
			"address_number" => "123",
			"address_neighborhood" => "Green Garden",
			"address_complement" => "---------------",
			"address_zipcode" => "12345678",
			"role" => UserEnum::CLIENT,
			"phones" => [
      			"phone" => "11987654321"
			],
		];

		$response = $this->post($this->baseUri, $data);

		$response->assertStatus(201);
		
		$this->assertDatabaseHas('users', $data);
	}
}
