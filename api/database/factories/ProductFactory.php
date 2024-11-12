<?php

namespace Database\Factories;

use App\Enums\ProductEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 5, 100),  // Preço entre 5 e 100
            'amount' => $this->faker->numberBetween(1, 100),
            'status' => $this->faker->randomElement([ProductEnum::STATUS_DRAFT, ProductEnum::STATUS_PUBLISHED]),
        ];
    }
}
