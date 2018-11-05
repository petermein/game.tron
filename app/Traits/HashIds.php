<?php

namespace App\Traits;


use Vinkla\Hashids\HashidsManager;

trait HashIds
{
    public function encode($value)
    {
        return app(HashidsManager::class)->encode($value);
    }

    public function decode($value)
    {
        return app(HashidsManager::class)->decode($value);
    }
}