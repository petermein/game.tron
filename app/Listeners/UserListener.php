<?php

namespace App\Listeners;


use App\Events\User\UserLoggedIn;
use App\Notifications\UserLoggedInNotifyTeam;
use Illuminate\Events\Dispatcher;

class UserListener
{
    /**
     * @var Dispatcher
     */
    private $dispatcher;

    /**
     * UserListener constructor.
     * @param Dispatcher $dispatcher
     */
    public function __construct(Dispatcher $dispatcher)
    {

        $this->dispatcher = $dispatcher;
    }

    /**
     * Handle user login events.
     */
    public function onUserLogin($event)
    {
        $event->user->touchLastLoggedIn();

        //Notifiy team of user log in
        $event->user->team->notify(new UserLoggedInNotifyTeam($event->user));
    }

    /**
     * Handle user logout events.
     */
    public function onUserLogout($event)
    {

    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen(\Illuminate\Auth\Events\Login::class, '\App\Listeners\UserListener@onUserLogin');

        $events->listen(\Illuminate\Auth\Events\Logout::class, '\App\Listeners\UserListener@onUserLogout');
    }
}