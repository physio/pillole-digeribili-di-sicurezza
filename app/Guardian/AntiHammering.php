<?php

namespace App\Guardian;

use GrahamCampbell\Throttle\Facades\Throttle;
use Illuminate\Support\Facades\Request;

class AntiHammering
{
    public function hint(): bool
    {

        Throttle::hit(Request::instance(), env('THROTTLE_COUNT', 5), env('THROTTLE_TIME_SPAN', 60));

        return $this->throttled();
    }

    public function throttled(): bool
    {
        return !Throttle::check(Request::instance());
    }
}
