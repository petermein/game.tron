<?php

namespace App\Models;

use App\Events\TeamLocation\NewTeamLocation;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Model;

class TeamLocation extends Model
{
    use SpatialTrait;

    protected $fillable = [
        'user_id',
        'team_id',
        'game_client_id',
        'location',
        'last_contact',
    ];

    protected $spatialFields = [
        'location',
    ];

    protected $dispatchesEvents = [
        'created' => NewTeamLocation::class,
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gameClient()
    {
        return $this->belongsTo(GameClient::class);
    }
}
