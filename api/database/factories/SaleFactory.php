<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 11),
            'total_price' => $this->faker->randomFloat(2, 20, 500),  // Total entre 20 e 500
            'date' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
