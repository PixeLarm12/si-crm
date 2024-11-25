<?php

namespace Database\Factories;

use App\Models\Genre;
use App\Models\Product;
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
			'product_id' => Product::query()->inRandomOrder()->value('id'),
			'genre_id'   => Genre::query()->inRandomOrder()->value('id'),
		];
	}
}
