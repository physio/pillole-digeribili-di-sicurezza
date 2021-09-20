<?php

namespace App\Guardian\Stages;

use App\Models\Action;
use App\Guardian\Contracts\Stage;

class FailedAttempts implements Stage {
    public function run(string $fingerpint, array $data, bool $failed): bool
    {
        if (!$failed) {
            return false;
        }

        Action::create([
            'fingerprint' => $fingerpint,
            'action' => FailedAttempts::class,
            'data' => data['ip']
        ]);
        
        return Action::where('fingerprint', $fingerpint)
            ->where('action', FailedAttempts::class)
            ->count() > 5;
    }
}