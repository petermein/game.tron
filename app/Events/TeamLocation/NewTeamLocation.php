<?php

namespace App\Events\TeamLocation;

use App\Models\TeamLocation;

class NewTeamLocation
{
    /**
     * @var TeamLocation
     */
    private $teamLocation;

    /**
     * NewTeamLocation constructor.
     * @param TeamLocation $teamLocation
     */
    public function __construct(TeamLocation $teamLocation)
    {
        $this->teamLocation = $teamLocation;
    }

    /**
     * @return TeamLocation
     */
    public function getTeamLocation(): TeamLocation
    {
        return $this->teamLocation;
    }
}