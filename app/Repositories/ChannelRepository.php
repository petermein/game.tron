<?php

namespace App\Repositories;


use App\Traits\HashIds;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;

class ChannelRepository
{
    use HashIds;

    public function globalGameChannel(): Channel
    {
        return new PrivateChannel('game');
    }

    public function teamNotificationChannelName($team_id): string
    {
        return 'team.' . $this->encode($team_id);
    }

    public function userNotificationChannelName($user_id): string
    {
        return 'user.' . $this->encode($user_id);
    }

}