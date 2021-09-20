<?php

namespace App\Guardian\Contracts;

interface Stage {
    public function run(string $fingerpint, array $data, bool $failed): bool;
}