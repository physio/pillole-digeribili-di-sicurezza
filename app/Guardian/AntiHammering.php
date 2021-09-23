<?php

namespace App\Guardian;

use GrahamCampbell\Throttle\Facades\Throttle;
use Illuminate\Support\Facades\Request;

class AntiHammering
{
    public function hint(): bool
    {
        $count = (getenv("THROTTLE_COUNT") !== false)? intval(env('THROTTLE_COUNT')) : 5;
        $time = (getenv("THROTTLE_TIME_SPAN") !== false)? intval(env('THROTTLE_TIME_SPAN')) : 60;

        Throttle::hit(Request::instance(), $count, $time);

        return $this->throttled();
    }

    public function throttled(): bool
    {
        return Throttle::check(Request::instance());
    }
}
