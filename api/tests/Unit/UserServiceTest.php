<?php

namespace Tests\Unit;

use App\Enums\UserEnum;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
	public function test_user_find() : void
	{
		$user = User::factory()->create();

		$service = new UserService(new UserRepository(new User()));

		$this->assertInstanceOf(User::class, $service->findRecord($user->id));
	}

	public function test_user_save() : void
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

		$service = new UserService(new UserRepository(new User()));

		$this->assertInstanceOf(User::class, $service->saveRecord($data));
	}

	public function test_user_update() : void
	{
		$faker = \Faker\Factory::create();

		$user = User::factory()->create();

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

		$service = new UserService(new UserRepository(new User()));

		$this->assertInstanceOf(User::class, $service->updateRecord($user->id, $data));
	}

	public function test_user_delete() : void
	{
		$user = User::factory()->create();

		$service = new UserService(new UserRepository(new User()));

		$this->assertTrue($service->deleteRecord($user->id));
	}
}
