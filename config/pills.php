<?php

use App\Guardian\Stages\FailedAttempts;
use App\Guardian\Stages\DifferentFingerprint;
use App\Guardian\Stages\AsnLookup;
use App\Guardian\Stages\IpThreat;

return [
    'threshold' => 15,

    'stages' => [
        FailedAttempts::class => 10,
        DifferentFingerprint::class => 5,
        AsnLookup::class => 8,
        IpThreat::class => 12
    ]
];
