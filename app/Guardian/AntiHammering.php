<?php

namespace App\Guardian;

use GrahamCampbell\Throttle\Facades\Throttle;
use Illuminate\Support\Facades\Request;

class AntiHammering
{
    public function hint(): bool
    {
        Throttle::hit(Request::instance(), env('THROTTLE_COUNT'), env('THROTTLE_TIME_SPAN'));

        return $this->throttled();
    }

    public function throttled(): bool
    {
        return Throttle::check(Request::instance());
    }
}
