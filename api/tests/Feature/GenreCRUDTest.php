<?php

namespace Tests\Feature;

use App\Enums\AbstractEnum;
use App\Enums\GenreEnum;
use App\Models\Genre;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class GenreCRUDTest extends TestCase
{
	private $baseUri = '/' . AbstractEnum::API_ROUTE_PREFIX . '/' . GenreEnum::ROUTE_PREFIX;

	public function test_if_index_route_returns_successful() : void
	{
		$response = $this->get($this->baseUri);

		$response->assertStatus(Response::HTTP_OK);
	}

	public function test_if_store_route_creates_resource_successfully(): void
	{
		$faker = \Faker\Factory::create();

		$data = [
			'title' => $faker->sentence(2),
		];

		$response = $this->post($this->baseUri, $data);

		$response->assertStatus(Response::HTTP_CREATED);

		$this->assertDatabaseHas('genres', $data);
	}

	public function test_if_update_route_modifies_resource_successfully(): void
	{
		$faker = \Faker\Factory::create();

		$genre = Genre::factory()->create();

		$data = [
			'title' => $faker->sentence(2),
		];

		$response = $this->put("{$this->baseUri}/{$genre->id}", $data);

		$response->assertStatus(Response::HTTP_CREATED);
	}

	public function test_if_delete_route_removes_resource_successfully(): void
	{
		$genre = Genre::factory()->create();

		$response = $this->delete("{$this->baseUri}/{$genre->id}");

		$response->assertStatus(Response::HTTP_NO_CONTENT);
		$this->assertDatabaseMissing('genres', ['id' => $genre->id]);
	}

}
