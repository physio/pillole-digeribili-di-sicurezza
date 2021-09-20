<?php

use App\Guardian\Stages\FailedAttempts;
use App\Guardian\Stages\DifferentFingerprint;
use App\Guardian\Stages\AsnLookup;

return [
    'threshold' => 15,

    'stages' => [
        FailedAttempts::class => 10,
        DifferentFingerprint::class => 5,
        AsnLookup::class => 8
    ]
];
