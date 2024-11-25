<?php

namespace Database\Seeders;

use App\Models\Assistance;
use Illuminate\Database\Seeder;

class AssistanceSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run() : void
	{
		Assistance::factory()->count(100)->create();
	}
}
