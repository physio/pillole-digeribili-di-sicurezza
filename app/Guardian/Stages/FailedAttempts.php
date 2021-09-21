<?php

namespace App\Guardian\Stages;

use Carbon\Carbon;
use App\Models\Action;
use App\Guardian\Contracts\Stage;
use App\Guardian\LoginData;
use App\Guardian\ActionsRepository;

class FailedAttempts implements Stage {


    private $actions;

    function __construct(ActionsRepository $actions)
    {
        $this->actions = $actions;
    }

    public function run(LoginData $data): bool {
        if ($data->logged()) {
            return false;
        }

        $this->actions(FailedAttempts::class);
       
        return $this->action(FailedAttempts::class)
            ->whereDate('created_at', Carbon::today())            
            ->count() > env('GUARDIAN_LOGIN_ATTEMPT', 5);
    }
}