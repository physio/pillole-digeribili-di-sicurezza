<?php

namespace App\Events;

use Illuminate\Support\Facades\Auth;
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
        $this->guardian->run('fingerprint', $request->all(), true);
    }

    public function attempt($credentials)
    {
        
    }

    public function lockout($lockout)
    {
        //
    }
}