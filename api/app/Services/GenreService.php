<?php

namespace App\Services;

use App\Repositories\GenreRepository;

class GenreService extends BaseService
{
    public function __construct(GenreRepository $repository) 
    {
        parent::__construct($repository);
    }
}