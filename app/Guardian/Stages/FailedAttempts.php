<?php

namespace App\Guardian\Stages;

use Carbon\Carbon;
use App\Models\Action;
use App\Guardian\Contracts\Stage;
use App\Guardian\Data;

class FailedAttempts implements Stage {
    public const ATTEMPTS = 5;

    public function run(Data $data): bool
    {
        if ($data->logged()) {
            return false;
        }

        Action::create([
            'fingerprint' => $data->fingerpint,
            'action' => FailedAttempts::class,
            'data' => $data->ip()
        ]);
        
        return Action::where('fingerprint', $data->fingerpint)
            ->where('action', FailedAttempts::class)
            ->whereDate('created_at', Carbon::today())            
            ->count() > FailedAttempts::ATTEMPTS;
    }
}