<?php

namespace Tests\Feature;

use App\Enums\AbstractEnum;
use App\Enums\UserEnum;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UserCRUDTest extends TestCase
{
	private $baseUri = '/' . AbstractEnum::API_ROUTE_PREFIX . '/' . UserEnum::ROUTE_PREFIX;

	public function test_if_index_route_returns_successful() : void
	{
		$response = $this->get($this->baseUri);

		$response->assertStatus(status: Response::HTTP_OK);
	}

	public function test_if_store_route_creates_resource_successfully() : void
	{
		$faker = \Faker\Factory::create();

		$data = [
			'name'                  => $faker->name,
			'email'                 => $faker->unique()->safeEmail,
			'password'              => 'strongPassword12#$',
			'password_confirmation' => 'strongPassword12#$',
			'cpf'                   => $faker->numberBetween(11111111111, 99999999999),
			'birth_date'            => $faker->date('Y-m-d', '-18 years'),  // Data de nascimento (maior de idade)
			'address'               => $faker->streetAddress,
			'address_number'        => $faker->numberBetween(1, 200),
			'address_neighborhood'  => ucfirst($faker->word()) . ' ' . $faker->citySuffix(),
			'address_complement'    => $faker->optional()->secondaryAddress,
			'address_zipcode'       => $faker->numberBetween(11111111, 99999999),
			'role'                  => $faker->randomElement([UserEnum::CLIENT, UserEnum::EMPLOYEE]),
			'phones'                => [
				['phone' => $faker->numberBetween(11111111111, 99999999999)],
			],
		];

		$response = $this->post($this->baseUri, $data);

		$user = json_decode($response->content(), true);
		$response->assertStatus(Response::HTTP_CREATED);

		$this->assertDatabaseHas('users', [
			'name'                 => $user['name'],
			'email'                => $user['email'],
			'cpf'                  => $user['cpf'],
			'birth_date'           => $user['birth_date'],
			'address'              => $user['address'],
			'address_number'       => $user['address_number'],
			'address_neighborhood' => $user['address_neighborhood'],
			'address_complement'   => $user['address_complement'],
			'address_zipcode'      => $user['address_zipcode'],
			'role'                 => $user['role'],
		]);
	}

	public function test_if_update_route_modifies_resource_successfully() : void
	{
		$faker = \Faker\Factory::create();

		$user = User::factory()->create();

		$data = [
			'name'                 => $faker->name,
			'email'                => $user->email,
			'cpf'                  => $user->cpf,
			'birth_date'           => $user->birth_date,
			'address'              => $user->address,
			'address_number'       => $user->address_number,
			'address_neighborhood' => $user->address_neighborhood,
			'address_complement'   => $user->address_complement,
			'address_zipcode'      => $user->address_zipcode,
			'role'                 => $user->role,
			'phones'               => [
				[
					'phone' => $user->phones()->first()->phone,
				],
				[
					'phone' => $faker->numberBetween(111111111111111, 999999999999999),
				],
			],
		];

		$response = $this->put("{$this->baseUri}/{$user->id}", $data);

		$response->assertStatus(Response::HTTP_CREATED);

		unset($data['phones']);

		$this->assertDatabaseHas('users', $data);
	}

	public function test_if_delete_route_removes_resource_successfully() : void
	{
		$user = User::factory()->create();

		$response = $this->delete("{$this->baseUri}/{$user->id}");

		$response->assertStatus(Response::HTTP_NO_CONTENT);
		$this->assertSoftDeleted('users', ['id' => $user->id]);
	}
}
