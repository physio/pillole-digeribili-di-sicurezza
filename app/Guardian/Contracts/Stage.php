<?php

namespace App\Guardian\Contracts;

use App\Guardian\Data;
use App\Guardian\LoginData;

interface Stage {
    public function run(LoginData $data): bool;
}