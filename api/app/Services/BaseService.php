<?php

namespace App\Services;

use App\Enums\LogEnum;
use App\Models\Log;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseService
{
	/**
	 * @var BaseRepository
	 */
	protected BaseRepository $repository;

	public function __construct($repository)
	{
		$this->repository = $repository;
	}

	/**
	 * List all records from Repository.
	 *
	 * @return \Illuminate\Support\Collection
     */
	public function getAllRecords() : \Illuminate\Support\Collection
    {
		return $this->repository->all();
	}

	/**
	 * Create a new record with Repository.
	 *
	 * @param array $data
	 * @return Model
	 */
	public function saveRecord(array $data) : Model
	{
        $user = $this->repository->create($data);

		Log::create([
			'user_id' => auth()->id(),
			'action' => LogEnum::CREATE,
			'model' => $this->repository->getModel(),
            'model_id' => $user->id,
            'data' => json_encode($data)
		]);
		return $user;
	}

	/**
	 * List record details with Repository
	 *
	 * @return Model
	 */
	public function findRecord(int $id) : Model
	{
		return $this->repository->find($id);
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
        $record = $this->repository->find($id);
        $record->update($data);

		Log::create([
			'user_id' => auth()->id(),
			'action' => LogEnum::UPDATE,
			'model' => $this->repository->getModel(),
            'model_id' => $id,
            'data' => json_encode($data)
		]);

		return $record;
	}

	/**
	 * Delete a record by ID.
	 *
	 * @param int $id
	 * @return bool|null
	 * @throws \Exception
	 */
	public function deleteRecord(int $id) : ?bool
	{
		Log::create([
			'user_id' => auth()->id(),
			'action' => LogEnum::DELETE,
			'model' => $this->repository->getModel(),
            'model_id' => $id,
            'data' => json_encode([
                'id' => $id
            ])
		]);
		$record = $this->repository->find($id);

		return $record->delete();
	}
}
