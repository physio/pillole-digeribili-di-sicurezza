<?php

namespace App\Guardian\Stages;

use Carbon\Carbon;
use App\Models\Action;
use App\Guardian\Contracts\Stage;
use App\Guardian\Data;
use App\Guardian\ActionsRepository;

class DifferentFingerprint implements Stage {
    private $actions;

    function __construct(ActionsRepository $actions)
    {
        $this->actions = $actions;
    }

    public function run(Data $data): bool
    {
        if (!$data->logged()) {
            return false;
        }
        
        $logins = $this->action('success')
            ->orderBy('created_at', 'desc')
            ->take(2);

        if (count($logins) < 2) {
            return false;
        }        
        
        return $logins[0]->fingerptint != $logins[1]->fingerptint;
    }
}