<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use App\Repositories\GenreRepository;
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
	 * @return Collection
	 */
	public function getAllRecords() : Collection
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
		return $this->repository->create($data);
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
	public function updateRecord(int $id, array $data) : bool
	{
		$record = $this->repository->find($id);

		return $record->update($data);
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
		$record = $this->repository->find($id);

		return $record->delete();
	}
}