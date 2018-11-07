<?php

namespace App\Models;

use App\Repositories\ChannelRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Team extends Model
{
    use Notifiable;
    use SoftDeletes;

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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tail()
    {
        return $this->hasOne(TeamTail::class, 'team_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scores()
    {
        return $this->hasMany(TeamScore::class);
    }

    /**
     * @return mixed
     */
    public function getCurrentScore()
    {
        return $this->scores()->sum('');
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
