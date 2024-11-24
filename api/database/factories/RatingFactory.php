<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition() : array
	{
		return [
			'user_id'    => User::query()->inRandomOrder()->value('id'),
			'product_id' => $this->faker->numberBetween(1, 10),
			'rate'       => $this->faker->randomFloat(1, 1, 5),
			'date'       => $this->faker->dateTimeBetween('-1 year', 'now'),
		];
	}
}
