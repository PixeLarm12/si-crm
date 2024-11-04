<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class BaseRepository
{
	/**
	 * @var Model
	 */
	protected $model;

	/**
	 * @param Model $model
	 */
	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	/**
	 * List all records from Eloquent model.
	 *
	 * @return Collection
	 */
	public function all() : Collection
	{
		return $this->model->all();
	}

	/**
	 * Create a new record with Eloquent Model.
	 *
	 * @param array $data
	 * @return Model
	 */
	public function create(array $data) : Model
	{
		return $this->model->create($data);
	}

	/**
	 * List record details with Eloquent
	 *
	 * @return Model
	 */
	public function find(int $id) : Model
	{
		return $this->model->findOrFail($id);
	}

	/**
	 * Update record with Eloquent Model by ID.
	 *
	 * @param int $id
	 * @param array $data
	 * @return bool
	 */
	public function update(int $id, array $data) : bool
	{
		$record = $this->find($id);

		return $record->update($data);
	}

	/**
	 * Delete a record by ID.
	 *
	 * @param int $id
	 * @return bool|null
	 * @throws \Exception
	 */
	public function delete(int $id) : ?bool
	{
		$record = $this->model->findOrFail($id);

		return $record->delete();
	}
}
