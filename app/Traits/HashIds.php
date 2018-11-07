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
        $decoded = app(HashidsManager::class)->decode($value);

        if (is_array($decoded)) {
            return $decoded[0];
        }

        return $decoded;
    }
}