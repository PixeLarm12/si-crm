<?php

namespace Tests\Unit;

use App\Models\Genre;
use App\Repositories\GenreRepository;
use App\Services\GenreService;
use Tests\TestCase;

class GenreServiceTest extends TestCase
{
	public function test_genre_find() : void
	{
		$genre = Genre::factory()->create();


		$service = new GenreService(new GenreRepository(new Genre()));

		$this->assertInstanceOf(Genre::class, $service->findRecord($genre->id));
	}

	public function test_genre_save() : void
	{
		$faker = \Faker\Factory::create();

		$data = [
			'title' => $faker->sentence(2),
		];

		$service = new GenreService(new GenreRepository(new Genre()));

		$this->assertInstanceOf(Genre::class, $service->saveRecord($data));
	}

	public function test_genre_update() : void
	{
		$faker = \Faker\Factory::create();

		$genre = Genre::factory()->create();
		
		$data = [
			'title' => $faker->sentence(2),
		];

		$service = new GenreService(new GenreRepository(new Genre()));

		$this->assertInstanceOf(Genre::class, $service->updateRecord($genre->id, $data));
	}

	public function test_genre_delete() : void
	{
		$genre = Genre::factory()->create();

		$service = new GenreService(new GenreRepository(new Genre()));

		$this->assertTrue($service->deleteRecord($genre->id));
	}
}
