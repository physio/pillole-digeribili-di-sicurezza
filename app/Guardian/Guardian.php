<?php

namespace App\Guardian;

use App\Guardian\LoginData;
use App\Guardian\ActionsRepository;

class Guardian {    
    private $data;

    private $actions;

    function __construct(LoginData $data, ActionsRepository $actions)
    {
        $this->data = $data;

        $this->actions = $actions;
    }

    public function login(): void
    {
        $threshold = 0;

        if ($this->data->logged()) {
            $this->actions('success');
        }

        foreach(config('pills.stages') as $class => $weight) {
            $stage = resolve($class);

            if ($stage->run($thia->data)) {
                $threshold += $weight;
            }
        }

        if ($threshold > config('pills.threshold')) {
            // Notification & Action
        }
    }
}