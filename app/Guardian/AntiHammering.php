<?php

namespace App\Guardian;

use GrahamCampbell\Throttle\Facades\Throttle;
use Illuminate\Support\Facades\Request;

class AntiHammering
{
    public function hint(): void
    {
        Throttle::hit(Request::instance(), env('THROTTLE_COUNT'), env('THROTTLE_TIME_SPAN'));
    }

    public function throttled(): bool
    {
        return Throttle::check(Request::instance());
    }
}
