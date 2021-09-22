<?php

namespace App\Guardian;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LoginData {
    public function ip(): string
    {
        return Request::ip();
    }

    public function fingerprint(): ?string
    {
        return Request::get('fingerprint', null);
    }

    public function all(): array
    {
        return Request::all();
    }

    public function logged(): bool
    {
        return Auth::check();
    }
}
