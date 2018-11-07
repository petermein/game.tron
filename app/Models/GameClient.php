<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameClient extends Model
{

    protected $fillable = [
        'os',
        'version',
        'token',
        'device_token',
        'user_id',
        'last_contact',
    ];

    protected $touches = [

    ];

    /**
     * @return bool
     */
    public function touchLastContact()
    {
        $this->last_contact = $this->freshTimestamp();
        return $this->save();
    }
}
