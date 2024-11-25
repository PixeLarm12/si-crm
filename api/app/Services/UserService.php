<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;

class UserService extends BaseService
{
    public function __construct(UserRepository $repository)
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
        $user = parent::saveRecord($data);

        $user->phones()->createMany($data['phones']);

        return $user;
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

        $user = $this->repository->find($id);

        if ($data['phones']) {
            $user->phones()->delete();
            $user->phones()->createMany($data['phones']);
        }

        return $updated;
    }
}
