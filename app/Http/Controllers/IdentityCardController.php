<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IdentityCardController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('log')->only('index');
    }

    public function show(){

        return true;
    }
}
