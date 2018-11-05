<?php

namespace App\Repositories;


use App\Models\Team;
use Prettus\Repository\Eloquent\BaseRepository;

class TeamRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Team::class;
    }
}