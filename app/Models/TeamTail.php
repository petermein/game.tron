<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamTail extends Model
{
    protected $primaryKey = 'team_id';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
