<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run()
	{
		$this->call([
			UserSeeder::class,
			PhoneSeeder::class,
			GenreSeeder::class,
			ProductSeeder::class,
			NotificationSeeder::class,
			ProductGenreSeeder::class,
			RatingSeeder::class,
			SaleSeeder::class,
			SaleItemSeeder::class,
			AssistanceSeeder::class,
		]);
	}
}
