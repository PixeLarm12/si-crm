<?php

namespace App\Services;

use App\Enums\LogEnum;
use App\Models\Log;
use App\Repositories\BaseRepository;
use DB;
use Exception;
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
		DB::beginTransaction(); 
		
		try {
			$record = $this->repository->create($data);
			
			Log::create([
					'user_id'  => auth()->id(),
					'action'   => LogEnum::CREATE,
					'model'    => $this->repository->getModel(),
					'model_id' => $record->id,
					'data'     => json_encode($data),
			]);

			DB::commit();

			return $record;
		} catch (Exception $e) {
			DB::rollback();

			throw new Exception('An error occurred saving record');
		}
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
		DB::beginTransaction(); 
		
		try {
			$record = $this->repository->find($id);
			$record->update($data);

			Log::create([
				'user_id'  => auth()->id(),
				'action'   => LogEnum::UPDATE,
				'model'    => $this->repository->getModel(),
				'model_id' => $id,
				'data'     => json_encode($data),
			]);

			DB::commit();

			return $record;
		} catch (Exception $e) {
			DB::rollback();

			throw new Exception('An error occurred updating record');
		}
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
		DB::beginTransaction(); 
		
		try {
			Log::create([
				'user_id'  => auth()->id(),
				'action'   => LogEnum::DELETE,
				'model'    => $this->repository->getModel(),
				'model_id' => $id,
				'data'     => json_encode([
					'id' => $id,
				]),
			]);
			$record = $this->repository->find($id);
			$delete = $record->delete();

			DB::commit();
			
			return $delete;
		} catch (Exception $e) {
			DB::rollback();

			throw new Exception('An error occurred deleting record');
		}
	}
}
