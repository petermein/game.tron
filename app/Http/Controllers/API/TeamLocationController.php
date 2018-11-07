<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreLocationRequest;
use App\Services\TeamLocationService;
use Illuminate\Contracts\Auth\Guard;

class TeamLocationController extends ApiController
{
    /**
     * @var TeamLocationService
     */
    private $teamLocationService;
    /**
     * @var Guard
     */
    private $auth;

    /**
     * TeamLocationController constructor.
     * @param Guard $auth
     * @param TeamLocationService $teamLocationService
     */
    public function __construct(TeamLocationService $teamLocationService)
    {
        $this->teamLocationService = $teamLocationService;
    }

    /**
     * @param StoreLocationRequest $request
     * @param Guard $auth
     * @return \App\Models\TeamLocation
     */
    public function store(StoreLocationRequest $request, Guard $auth)
    {
        return $this->teamLocationService->addTeamLocation($auth->user(), $request->get('location'));
    }
}