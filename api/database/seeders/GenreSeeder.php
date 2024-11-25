<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run() : void
	{
		// Genre::factory()->count(random_int(1, 20))->create();
		$dataFromDataset = [
			'Comedy',
			'Drama',
			'Romance',
			'Action',
			'Adventure',
			'Sci-Fi',
			'Biography',
			'History',
			'Sport',
			'Horror',
			'Thriller',
			'War',
			'Fantasy',
			'Crime',
			'Mystery',
			'Animation',
			'Music',
			'Documentary',
			'Family',
			'Musical',
			'Western',
			'Film-Noir'
		];

		foreach($dataFromDataset as $genre) {
			Genre::create([
				'title' => $genre
			]);
		}
	}
}
