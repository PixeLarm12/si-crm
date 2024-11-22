<?php

namespace Tests\Feature;

use App\Enums\AbstractEnum;
use App\Enums\NotificationEnum;
use App\Enums\UserEnum;
use App\Models\Notification;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class NotificationCRUDTest extends TestCase
{
	private $baseUri = '/' . AbstractEnum::API_ROUTE_PREFIX . '/' . NotificationEnum::ROUTE_PREFIX;

	public function test_if_index_route_returns_successful() : void
	{
		$response = $this->get($this->baseUri);

		$response->assertStatus(Response::HTTP_OK);
	}

	public function test_if_store_route_creates_resource_successfully() : void
	{
		$faker = \Faker\Factory::create();

		$data = [
			'user_id' => User::where('role', UserEnum::CLIENT)->first()->id,
			'title'   => $faker->sentence(2),
			'message' => $faker->text(255),
			'type'    => $faker->randomElement([NotificationEnum::STATUS_UNREAD, NotificationEnum::STATUS_READ]),
		];

		$response = $this->post($this->baseUri, $data);

		$response->assertStatus(Response::HTTP_CREATED);

		$this->assertDatabaseHas('notifications', $data);
	}

	public function test_if_update_route_modifies_resource_successfully() : void
	{
		$faker = \Faker\Factory::create();

		$notification = Notification::factory()->create();

		$data = [
			'user_id' => $notification->user->id,
			'title'   => $faker->sentence(2),
			'message' => $faker->text(255),
			'type'    => $faker->randomElement([NotificationEnum::STATUS_UNREAD, NotificationEnum::STATUS_READ]),
		];

		$response = $this->put("{$this->baseUri}/{$notification->id}", $data);

		$response->assertStatus(Response::HTTP_CREATED);

		$this->assertDatabaseHas('notifications', $data);
	}

	public function test_if_delete_route_removes_resource_successfully() : void
	{
		$notification = Notification::factory()->create();

		$response = $this->delete("{$this->baseUri}/{$notification->id}");

		$response->assertStatus(Response::HTTP_NO_CONTENT);
		$this->assertDatabaseMissing('notifications', ['id' => $notification->id]);
	}
}
