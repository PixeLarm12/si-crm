<?php

namespace Database\Factories;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductGenre>
 */
class ProductGenreFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition() : array
	{
		return [
			'product_id' => $this->faker->numberBetween(1, 10000),
			'genre_id'   => Genre::query()->inRandomOrder()->value('id'),
		];
	}
}
