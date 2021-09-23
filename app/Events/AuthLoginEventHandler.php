<?php

namespace App\Events;

use App\Guardian\Guardian;
use App\Guardian\AntiHammering;

class AuthLoginEventHandler
{
    private $guardian;

    private $hammering;

    function __construct(Guardian $guardian, AntiHammering $hammering)
    {
        $this->guardian = $guardian;

        $this->hammering = $hammering;
    }

    public function login()
    {
        $this->guardian->run();

        if ($this->hammering->throttled()) {
            $this->guardian->throttled();

            abort(429, 'TOO MANY ATTEMPTS');
        }
    }

    public function attempt($credentials)
    {
        $this->hammering->hint();
    }

    public function lockout($lockout)
    {
        $this->hammering->hint();
    }
}
