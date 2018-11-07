<?php

namespace App\Services;


use App\Models\Team;
use App\Models\TeamLocation;
use App\Models\TeamTail;
use App\Models\User;
use App\Repositories\TeamLocationRepository;
use App\Repositories\TeamRepository;
use Grimzy\LaravelMysqlSpatial\Types\LineString;
use Grimzy\LaravelMysqlSpatial\Types\MultiLineString;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Eloquent\Collection;

class TeamLocationService
{
    /**
     * @var TeamRepository
     */
    private $teamRepository;
    /**
     * @var TeamLocationRepository
     */
    private $teamLocationRepository;

    /**
     * TeamLocationService constructor.
     * @param TeamRepository $teamRepository
     * @param TeamLocationRepository $teamLocationRepository
     */
    public function __construct(TeamRepository $teamRepository, TeamLocationRepository $teamLocationRepository)
    {
        $this->teamRepository = $teamRepository;
        $this->teamLocationRepository = $teamLocationRepository;
    }

    public function addTeamLocation(User $user, array $points)
    {
        $team = $this->teamRepository->byUser($user);
        $gameClient = $user->currentGameClient();

        //Verify conditions
        //Same client
        //

        //Create point
        $location = new Point($points[0], $points[1]);

        //Create location
        $teamLocation = $this->buildTeamLocation($user->id, $location, $team->id, $gameClient->id);
        $this->teamRepository->save($teamLocation);

        return $teamLocation;
    }

    public function buildTeamLocation($user_id, Point $location, $team_id, $game_client_id = null): TeamLocation
    {
        $teamLocation = $this->teamLocationRepository->new();

        $teamLocation->user_id = $user_id;
        $teamLocation->team_id = $team_id;
        $teamLocation->game_client_id = $game_client_id;
        $teamLocation->location = $location;

        return $teamLocation;
    }

    public function generateTeamTail(Team $team)
    {
        /** @var Collection $locations */
        $locations = TeamLocation::where('team_id', $team->id)->orderBy('created_at', 'desc')->limit(5)->get();

        $points = [];
        foreach ($locations as $location) {
            $points[] = $location->location;
        }

        $linestring = new LineString($points);

        //Create multilinstring
        $tail = TeamTail::firstOrNew(['team_id' => $team->id]);
        $tail->class = 'tail';
        $tail->linestring = new MultiLineString([$linestring]);
        $tail->active = 1;

        $tail->save();
    }

}