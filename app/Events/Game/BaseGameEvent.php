<?php

namespace App\Events\Game;


use App\Repositories\ChannelRepository;

abstract class BaseGameEvent
{
    /**
     * @var ChannelRepository
     */
    protected $channelRepository;

    public function __construct()
    {
        $this->channelRepository = app(ChannelRepository::class);
    }
}