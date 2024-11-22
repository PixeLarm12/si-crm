<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SaleItem>
 */
class SaleItemFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition() : array
	{
		return [
			'sale_id'     => Sale::query()->inRandomOrder()->value('id'),
			'product_id'  => Product::query()->inRandomOrder()->value('id'),
			'amount'      => $this->faker->numberBetween(1, 10),
			'unit_price'  => $this->faker->randomFloat(2, 5, 100),
			'total_price' => function (array $attributes) {
				return $attributes['amount'] * $attributes['unit_price'];
			},
		];
	}
}
