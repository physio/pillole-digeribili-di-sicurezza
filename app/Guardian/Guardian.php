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

    public function run(): void
    {
        $threshold = 0;

        if ($this->data->logged()) {
            $this->actions->action('success');
        }

        foreach(config('pills.stages') as $class => $weight) {
            $stage = resolve($class);

            if ($stage->run($this->data)) {
                $threshold += $weight;
            }
        }

        if ($threshold > config('pills.threshold')) {
            // Notification & Action
        }
    }

    public function throttled(): void
    {
        $this->actions->action('throttled');
    }
}
