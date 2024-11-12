<?php

namespace Database\Factories;

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
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 50),
            'title' => $this->faker->sentence,
            'message' => $this->faker->paragraph,
            'type' => $this->faker->randomElement(['info', 'warning', 'error']),
            'date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'check_date' => $this->faker->optional()->dateTimeBetween('-1 year', 'now'),
            'status' => $this->faker->randomElement(['unread', 'read']),
        ];
    }
}
