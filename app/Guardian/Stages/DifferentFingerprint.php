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
        if (!$data->logged()) {
            return false;
        }

        $logins = $this->actions->action('success')
            ->orderBy('created_at', 'desc')
            ->take(2);

        if (count(array($logins)) < 2) {
            return false;
        }

        $this->actions->create(DifferentFingerprint::class, 'Different ' . $logins[0]->fingerprint != $logins[1]->fingerprint);

        return $logins[0]->fingerprint != $logins[1]->fingerprint;
    }
}
