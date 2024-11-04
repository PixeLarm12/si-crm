<?php

namespace App\Repositories;

use App\Models\Assistance;

class AssistanceRepository extends BaseRepository
{
    public function __construct(Assistance $model)
    {
        parent::__construct($model);
    }
}