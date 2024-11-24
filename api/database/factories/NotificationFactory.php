<?php

namespace Database\Factories;

use App\Enums\NotificationEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition() : array
	{
		return [
			'user_id'    => User::query()->inRandomOrder()->value('id'),
			'title'      => $this->faker->sentence(2),
			'message'    => $this->faker->text(255),
			'type'       => $this->faker->randomElement([NotificationEnum::TYPE_PURCHASE, NotificationEnum::TYPE_OFFER, NotificationEnum::TYPE_PROBLEM]),
			'date'       => $this->faker->dateTimeBetween('-1 year', 'now'),
			'check_date' => $this->faker->optional()->dateTimeBetween('-1 year', 'now'),
			'status'     => $this->faker->randomElement([NotificationEnum::STATUS_UNREAD, NotificationEnum::STATUS_READ]),
		];
	}
}
