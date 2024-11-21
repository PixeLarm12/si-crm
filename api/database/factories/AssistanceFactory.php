<?php

namespace Database\Factories;

use App\Enums\AssistanceEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assistance>
 */
class AssistanceFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition() : array
	{
		return [
			'opened_by'  => $this->faker->numberBetween(1, 10),
			'admin_id'   => $this->faker->numberBetween(1, 10),
			'type'       => $this->faker->randomElement([AssistanceEnum::TYPE_COMPLAINT, AssistanceEnum::TYPE_SUGGEST, AssistanceEnum::TYPE_PROBLEM]),
			'subject'    => $this->faker->sentence(2),
			'message'    => $this->faker->text(255),
			'open_date'  => $this->faker->dateTimeBetween('-1 year', 'now'),
			'close_date' => $this->faker->optional()->dateTimeBetween('-1 year', 'now'),
			'status'     => $this->faker->randomElement([AssistanceEnum::STATUS_OPENED, AssistanceEnum::STATUS_CLOSED]),
		];
	}
}
