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
        $throttled = $this->hammering->hint();

        $this->guardian->run($throttled);
    }

    public function attempt($credentials)
    {
        //
    }

    public function lockout($lockout)
    {
        $this->hammering->hint();
    }
}
