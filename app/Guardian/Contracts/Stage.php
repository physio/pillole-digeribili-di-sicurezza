<?php

namespace App\Guardian\Contracts;

use App\Guardian\Data;

interface Stage {
    public function run(Data $data): bool;
}