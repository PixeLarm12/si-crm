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
			'opened_by'  => $this->faker->numberBetween(1, 10),  // ID do usuário que abriu
			'admin_id'   => $this->faker->numberBetween(1, 10),   // ID do administrador
			'type'       => $this->faker->randomElement([AssistanceEnum::TYPE_COMPLAINT, AssistanceEnum::TYPE_SUGGEST, AssistanceEnum::TYPE_PROBLEM]), // Tipos de assistência
			'subject'    => $this->faker->word,
			'message'    => $this->faker->text(255),
			'open_date'  => $this->faker->dateTimeBetween('-1 year', 'now'),  // Data de abertura
			'close_date' => $this->faker->optional()->dateTimeBetween('-1 year', 'now'),  // Data de fechamento (opcional)
			'status'     => $this->faker->randomElement([AssistanceEnum::STATUS_OPENED, AssistanceEnum::STATUS_CLOSED]), // Status da assistência
		];
	}
}
