<?php

namespace App\Models;

use App\Repositories\ChannelRepository;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'team_id',
        'last_logged_in',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'last_logged_in',
    ];

    protected $gameClientId;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function gameClients()
    {
        return $this->hasMany(GameClient::class);
    }

    /**
     * @return bool
     */
    public function touchLastLoggedIn()
    {
        $this->last_logged_in = $this->freshTimestamp();
        return $this->save();
    }

    /**
     * The channels the user receives notification broadcasts on.
     *
     * @return string
     */
    public function receivesBroadcastNotificationsOn()
    {
        return app(ChannelRepository::class)->userNotificationChannelName($this->id);
    }

    /**
     * @param $id
     */
    public function setCurrentGameClientId($id)
    {
        $this->gameClientId = $id;
    }

    /**
     * @return int|null
     */
    public function getCurrentGameClientId()
    {
        return $this->gameClientId;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function currentGameClient()
    {
        return $this->gameClients()->find($this->gameClientId);
    }
}
