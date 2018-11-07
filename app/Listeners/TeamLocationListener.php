<?php

namespace App\Listeners;


use App\Events\TeamLocation\NewTeamLocation;
use App\Services\TeamLocationService;
use Illuminate\Events\Dispatcher;

class TeamLocationListener
{
    /**
     * @var Dispatcher
     */
    private $dispatcher;
    /**
     * @var TeamLocationService
     */
    private $teamLocationService;

    /**
     * UserListener constructor.
     * @param Dispatcher $dispatcher
     * @param TeamLocationService $teamLocationService
     */
    public function __construct(Dispatcher $dispatcher, TeamLocationService $teamLocationService)
    {
        $this->dispatcher = $dispatcher;
        $this->teamLocationService = $teamLocationService;
    }

    /**
     * @param $event
     */
    public function onNewTeamLocation(NewTeamLocation $event)
    {
        $teamLocation = $event->getTeamLocation();
        $team = $teamLocation->team;

        //Trigger recalculate tail
        $this->teamLocationService->generateTeamTail($team);
    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen(NewTeamLocation::class, '\App\Listeners\TeamLocationListener@onNewTeamLocation');
    }
}