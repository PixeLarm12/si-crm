<?php

namespace App\Repositories;

use App\Models\Phone;

class PhoneRepository extends BaseRepository
{
    public function __construct(Phone $model)
    {
        parent::__construct($model);
    }
}