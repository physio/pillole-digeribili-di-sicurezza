<?php

use App\Guardian\Stages\FailedAttempts;
use App\Guardian\Stages\DifferentFingerprint;

return [
    'threshold' => 15,

    'stages' => [
        FailedAttempts::class => 10,
        DifferentFingerprint::class => 5
    ]
];
