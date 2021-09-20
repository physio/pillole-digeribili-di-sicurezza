<?php

use App\Guardian\Stages\FailedAttempts;

return [
    'threshold' => 15,

    'stages' => [
        FailedAttempts::class => 10
    ]
];
