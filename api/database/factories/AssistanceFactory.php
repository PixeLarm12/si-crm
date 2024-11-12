<?php

namespace Database\Factories;

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
    public function definition(): array
    {
        return [
            'opened_by' => $this->faker->numberBetween(1, 50),  // ID do usuário que abriu
            'admin_id' => $this->faker->numberBetween(1, 10),   // ID do administrador
            'type' => $this->faker->randomElement(['technical', 'billing', 'general']), // Tipos de assistência
            'subject' => $this->faker->sentence(),
            'message' => $this->faker->paragraph(),
            'open_date' => $this->faker->dateTimeBetween('-1 year', 'now'),  // Data de abertura
            'close_date' => $this->faker->optional()->dateTimeBetween('-1 year', 'now'),  // Data de fechamento (opcional)
            'status' => $this->faker->randomElement(['open', 'in_progress', 'closed']), // Status da assistência
        ];
    }
}
