<?php

namespace App\Http\Controllers\API;

class TestController extends ApiController
{
    public function test()
    {
        throw new \Exception('tset');
        dd(auth()->user()->currentGameClient());
    }
}