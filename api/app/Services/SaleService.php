<?php

namespace App\Services;

use App\Repositories\SaleRepository;
use Illuminate\Database\Eloquent\Model;

class SaleService extends BaseService
{
	public function __construct(SaleRepository $repository)
	{
		parent::__construct($repository);
	}

	/**
	 * Create a new record with Repository.
	 *
	 * @param array $data
	 * @return Model
	 */
	public function saveRecord(array $data) : Model
	{
		$sale = parent::saveRecord($data);

		$sale->items()->createMany($data['items']);

		return $sale;
	}

	/**
	 * Update record with Repository by ID.
	 *
	 * @param int $id
	 * @param array $data
	 * @return Model
	 */
	public function updateRecord(int $id, array $data) : Model
	{
		$updated = parent::updateRecord($id, $data);
		$sale = $this->repository->find($id);

		$sale->update($data);

		if ($data['items']) {
			$sale->items()->delete();

			$sale->items()->createMany($data['items']);
		}

		return $updated;
	}
}
