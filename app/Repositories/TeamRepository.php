<?php

namespace App\Repositories;


use App\Models\Team;
use App\Models\TeamLocation;
use App\Models\User;
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

    /**
     * @param User $user
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function byUser(User $user): Team
    {
        return $user->team;
    }

    /**
     * @param TeamLocation $teamLocation
     * @return bool
     */
    public function save(TeamLocation $teamLocation)
    {
        return $teamLocation->save();
    }
}