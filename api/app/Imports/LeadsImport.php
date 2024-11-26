<?php

namespace App\Imports;

use App\Enums\UserEnum;
use App\Models\User;
use DB;
use Exception;
use Hash;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class LeadsImport implements ToCollection
{
	private int $current = 0;

	/**
	 * @param Collection $collection
	 */
	public function collection(Collection $collection)
	{
		foreach ($collection as $key => $lead) {
			if ($key > 0 && $lead[0] != null) {
				$dateString = str_replace('"', '', trim($lead[4]));
				$timestamp = strtotime(str_replace('/', '-', $dateString));

				$emailDuplicatedCounter = User::where('email', $lead[1])->count();
				$cpfDuplicatedCounter = User::where('cpf', $lead[3])->count();

				if (empty($emailDuplicatedCounter) && empty($cpfDuplicatedCounter)) {
					$user = User::create(
						[
							'name'                 => trim($lead[0]),
							'email'                => trim($lead[1]),
							'password'             => trim(Hash::make($lead[2])),
							'cpf'                  => trim((int) $lead[3]),
							'birth_date'           => date('Y-m-d', $timestamp),
							'address'              => trim($lead[5]),
							'address_number'       => trim((int) $lead[6]),
							'address_neighborhood' => trim($lead[7]),
							'address_complement'   => trim($lead[8] ?? '-----'),
							'address_zipcode'      => trim((int) $lead[9]),
							'role'                 => UserEnum::CLIENT,
						]
					);

					$user->phones()->create([
						'phone' => trim((int) $lead[10]),
					]);
				}
			}
		}
	}
}
