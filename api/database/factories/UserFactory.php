<?php

namespace Database\Factories;

use App\Enums\UserEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
	/**
	 * The current password being used by the factory.
	 */
	protected static ?string $password;

	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition() : array
	{
		return [
			'name'                 => $this->faker->name,
			'email'                => $this->faker->unique()->safeEmail,
			'password'             => Hash::make('password'),
			'cpf'                  => $this->faker->numberBetween(11111111111, 99999999999),
			'birth_date'           => $this->faker->date('Y-m-d', '-18 years'),
			'address'              => $this->faker->streetAddress,
			'address_number'       => $this->faker->numberBetween(1, 200),
			'address_neighborhood' => ucfirst($this->faker->word()) . ' ' . $this->faker->citySuffix(),
			'address_complement'   => $this->faker->optional()->secondaryAddress,
			'address_zipcode'      => $this->faker->numberBetween(11111111, 99999999),
			'role'                 => $this->faker->randomElement([UserEnum::CLIENT, UserEnum::EMPLOYEE]),
		];
	}

	public function configure(): self
	{
		return $this->afterCreating(function ($user) {
			$user->phones()->create([
				'phone' => $this->faker->numberBetween(111111111111111, 999999999999999),
			]);
		});
	}
}
