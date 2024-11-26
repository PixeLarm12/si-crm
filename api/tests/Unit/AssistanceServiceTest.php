<?php

namespace Tests\Unit;

use App\Enums\AssistanceEnum;
use App\Enums\UserEnum;
use App\Models\Assistance;
use App\Models\User;
use App\Repositories\AssistanceRepository;
use App\Services\AssistanceService;
use Carbon\Carbon;
use Tests\TestCase;

class AssistanceServiceTest extends TestCase
{
	public function test_assistance_find() : void
	{
		$assistance = Assistance::factory()->create();

		$service = new AssistanceService(new AssistanceRepository(new Assistance()));

		$this->assertInstanceOf(Assistance::class, $service->findRecord($assistance->id));
	}

	public function test_assistance_save() : void
	{
		$faker = \Faker\Factory::create();

		$data = [
			'opened_by'  => User::where('role', UserEnum::CLIENT)->first()->id,
			'admin_id'   => User::where('role', UserEnum::ADMIN)->first()->id,
			'type'       => $faker->randomElement([AssistanceEnum::TYPE_COMPLAINT, AssistanceEnum::TYPE_SUGGEST, AssistanceEnum::TYPE_PROBLEM]),
			'subject'    => $faker->sentence(2),
			'message'    => $faker->text(255),
			'open_date'  => Carbon::now(),
			'close_date' => null,
			'status'     => AssistanceEnum::STATUS_OPENED,
		];

		$service = new AssistanceService(new AssistanceRepository(new Assistance()));

		$this->assertInstanceOf(Assistance::class, $service->saveRecord($data));
	}

	public function test_assistance_update() : void
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

		$service = new AssistanceService(new AssistanceRepository(new Assistance()));

		$this->assertInstanceOf(Assistance::class, $service->updateRecord($assistance->id, $data));
	}

	public function test_assistance_delete() : void
	{
		$assistance = Assistance::factory()->create();

		$service = new AssistanceService(new AssistanceRepository(new Assistance()));

		$this->assertTrue($service->deleteRecord($assistance->id));
	}
}
