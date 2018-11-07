<?php

namespace App\Models;

use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Model;

class TeamTail extends Model
{
    use SpatialTrait;

    protected $fillable = [
        'team_id',
        'linestring',
        'class',
        'active',
    ];

    protected $spatialFields = [
        'linestring',
    ];

    protected $primaryKey = 'team_id';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
