<?php

namespace App\Repositories;


use App\Models\TeamLocation;
use Prettus\Repository\Eloquent\BaseRepository;

class TeamLocationRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TeamLocation::class;
    }

    public function new()
    {
        return new $this->model();
    }
}