<?php

namespace Database\Seeders;

use App\Models\ProductGenre;
use Illuminate\Database\Seeder;

class ProductGenreSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run() : void
	{
		ProductGenre::factory()->count(1000)->create();
	}
}
