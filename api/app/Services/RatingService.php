<?php

namespace App\Services;

use App\Repositories\RatingRepository;

class RatingService extends BaseService
{
    public function __construct(RatingRepository $repository) 
    {
        parent::__construct($repository);
    }
}