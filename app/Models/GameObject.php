<?php

namespace App\Models;

use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Model;

class GameObject extends Model
{
    use SpatialTrait;

    protected $spatialFields = [
        'geo_object',
    ];
}
