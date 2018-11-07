<?php

namespace App\Http\Controllers\API;

class TestController extends ApiController
{
    public function test()
    {
        dd(auth()->user()->currentGameClient());
    }
}