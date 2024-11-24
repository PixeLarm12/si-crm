<?php

namespace Tests\Feature;

use App\Enums\AbstractEnum;
use App\Enums\AssistanceEnum;
use App\Enums\UserEnum;
use App\Models\Assistance;
use App\Models\User;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AssistanceCRUDTest extends TestCase
{
	private $baseUri = '/' . AbstractEnum::API_ROUTE_PREFIX . '/' . AssistanceEnum::ROUTE_PREFIX;

	public function test_if_index_route_returns_successful() : void
	{
		$response = $this->get($this->baseUri);

		$response->assertStatus(Response::HTTP_OK);
	}

	public function test_if_store_route_creates_resource_successfully() : void
	{
		$faker = \Faker\Factory::create();

		$data = [
			'opened_by'  => User::where('role', UserEnum::CLIENT)->first()->id,
			'admin_id'   => User::where('role', UserEnum::ADMIN)->first()->id,
			'type'       => $faker->randomElement([AssistanceEnum::TYPE_COMPLAINT, AssistanceEnum::TYPE_SUGGEST, AssistanceEnum::TYPE_PROBLEM]),
			'subject'    => $faker->sentence(2),
			'message'    => $faker->text(255),
			'close_date' => null,
			'status'     => AssistanceEnum::STATUS_OPENED,
		];

		$response = $this->post($this->baseUri, $data);

		$response->assertStatus(Response::HTTP_CREATED);

		$this->assertDatabaseHas('assistances', $data);
	}

	public function test_if_update_route_modifies_resource_successfully() : void
	{
		$faker = \Faker\Factory::create();

		$assistance = Assistance::factory()->create();

		$data = [
			'opened_by'  => $assistance->openedByUser->id,
			'admin_id'   => $assistance->admin->id,
			'type'       => $faker->randomElement([AssistanceEnum::TYPE_COMPLAINT, AssistanceEnum::TYPE_SUGGEST, AssistanceEnum::TYPE_PROBLEM]),
			'subject'    => $faker->sentence(2),
			'message'    => $faker->text(255),
			'close_date' => Carbon::now(),
			'status'     => AssistanceEnum::STATUS_CLOSED,
		];

		$response = $this->put("{$this->baseUri}/{$assistance->id}", $data);

		$response->assertStatus(Response::HTTP_CREATED);

		$this->assertDatabaseHas('assistances', $data);
	}

	public function test_if_delete_route_removes_resource_successfully() : void
	{
		$assistance = Assistance::factory()->create();

		$response = $this->delete("{$this->baseUri}/{$assistance->id}");

		$response->assertStatus(Response::HTTP_NO_CONTENT);
		$this->assertDatabaseMissing('assistances', ['id' => $assistance->id]);
	}
}
