<?php

namespace Tests\Feature;

use App\Enums\AbstractEnum;
use App\Enums\UserEnum;
use Tests\TestCase;

class UserRoutesTest extends TestCase
{
	private $baseUri = '/' . AbstractEnum::API_ROUTE_PREFIX . '/' . UserEnum::ROUTE_PREFIX;

	public function test_if_index_route_returns_successful() : void
	{
		$response = $this->get($this->baseUri);

		$response->assertStatus(200);
	}

	public function test_if_store_route_creates_resource_successfully(): void
	{
		$faker = \Faker\Factory::create();

		$data = [
			'name'                 => $faker->name,
			'email'                => $faker->unique()->safeEmail,
			'password'             => 'strongpass1234@!',
			'password_confirmation'=> 'strongpass1234@!',
			'cpf'                  => $faker->numberBetween(11111111111, 99999999999),
			'birth_date'           => $faker->date('Y-m-d', '-18 years'),  // Data de nascimento (maior de idade)
			'address'              => $faker->streetAddress,
			'address_number'       => $faker->numberBetween(1, 200),
			'address_neighborhood' => $faker->word,
			'address_complement'   => $faker->optional()->secondaryAddress,
			'address_zipcode'      => $faker->numberBetween(11111111, 99999999),
			'role'                 => $faker->randomElement([UserEnum::CLIENT, UserEnum::EMPLOYEE]),
			'phones' => [
				["phone" => $faker->numberBetween(11111111111, 99999999999)]
			]
		];

		$response = $this->post($this->baseUri, $data);

		$user = json_decode($response->content(), true);
		$response->assertStatus(201);

		$phones = $data["phones"];
		
		$this->assertDatabaseHas('users', $user);
		$this->assertDatabaseHas('phones', [
			"phone" => $phones[0]['phone']
		]);
	}
}
