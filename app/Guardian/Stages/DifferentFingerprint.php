<?php

namespace App\Guardian\Stages;

use Carbon\Carbon;
use App\Models\Action;
use App\Guardian\Contracts\Stage;
use App\Guardian\LoginData;
use App\Guardian\ActionsRepository;

class DifferentFingerprint implements Stage {
    private $actions;

    function __construct(ActionsRepository $actions)
    {
        $this->actions = $actions;
    }

    public function run(LoginData $data): bool
    {
        $logins = $this->actions->action('success')
            ->orderBy('created_at', 'desc')
            ->take(2);

        $this->actions->create(DifferentFingerprint::class, 'Different ' . $logins[0]->fingerprint != $logins[1]->fingerprint);

        if (count(array($logins)) < 2) {
            return false;
        }
        
        return $logins[0]->fingerprint != $logins[1]->fingerprint;
    }
}
