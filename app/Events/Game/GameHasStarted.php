<?php

namespace App\Events\Game;


class GameHasStarted extends BaseGameEvent
{
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|\Illuminate\Broadcasting\Channel[]
     */
    public function broadcastOn()
    {
        return [
            $this->channelRepository->globalGameChannel(),
        ];
    }
}