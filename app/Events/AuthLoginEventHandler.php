<?php

namespace App\Events;

use App\Guardian\Guardian;

class AuthLoginEventHandler
{
    private $guardian;

    function __construct(Guardian $guardian)
    {
        $this->guardian = $guardian;
    }

    public function login()
    {
        $this->guardian->run();
    }

    public function attempt($credentials)
    {
        
    }

    public function lockout($lockout)
    {
        //
    }
}