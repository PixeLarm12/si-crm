<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\SaleItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition() : array
	{
		return [
			'user_id'     => User::query()->inRandomOrder()->value('id'),
			'total_price' => $this->faker->randomFloat(2, 20, 500), 
			'date'        => $this->faker->dateTimeBetween('-1 year', 'now'),
		];
	}

	public function configure(): self
	{
		return $this->afterCreating(function ($sale) {
			$sale->items()->createMany(SaleItem::factory()->count(2)->make()->toArray());
		});
	}
}
