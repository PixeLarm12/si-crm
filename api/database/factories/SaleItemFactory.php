<?php

namespace Database\Factories;

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
		$amount = $this->faker->numberBetween(1, 10);
		$unitPrice = $this->faker->randomFloat(2, 0.5, 3000);

		return [
			'sale_id'     => Sale::query()->inRandomOrder()->value('id'),
			'product_id'  => $this->faker->numberBetween(1, 10000),
			'amount'      => $amount,
			'unit_price'  => $unitPrice,
			'total_price' => (float) ($amount * $unitPrice),
		];
	}
}
