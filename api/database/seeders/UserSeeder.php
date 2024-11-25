<?php

namespace Database\Seeders;

use App\Enums\UserEnum;
use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run() : void
	{
		$admin = User::create([
			'name'                 => 'User Admin',
			'email'                => 'user_email@email.com',
			'password'             => Hash::make('123456'),
			'cpf'                  => '00000000000',
			'birth_date'           => '2000-01-01',  // Data de nascimento (maior de idade)
			'address'              => 'Street',
			'address_number'       => '999',
			'address_neighborhood' => 'Neighborhood',
			'address_complement'   => 'Complement',
			'address_zipcode'      => '00000000',
			'role'                 => UserEnum::ADMIN,
		]);

		User::factory()->count(300)->create();
	}
}
