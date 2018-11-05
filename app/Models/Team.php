<?php

namespace App\Models;

use App\Repositories\ChannelRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Team extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * The channels the user receives notification broadcasts on.
     *
     * @return string
     */
    public function receivesBroadcastNotificationsOn()
    {
        return app(ChannelRepository::class)->teamNotificationChannelName($this->id);
    }

    /**
     * Route notifications for the Fcm channel.
     *
     * @return string|array
     */
    public function routeNotificationForFcm()
    {
        return ['123'];
    }
}