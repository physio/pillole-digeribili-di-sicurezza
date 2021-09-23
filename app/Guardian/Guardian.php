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

    public function run(bool $throttled): void
    {
        $threshold = 0;

        $this->actions->create($this->data->logged() ? 'success' : 'failded');

        foreach(config('pills.stages') as $class => $weight) {
            $stage = resolve($class);

            if ($stage->run($this->data)) {
                $threshold += $weight;
            }
        }

        if ($threshold > config('pills.threshold')) {
            // Notification & Action
        }

        if ($throttled && !$data->logged()) {
            $this->actions->action('throttled');

            abort(429, 'TOO MANY ATTEMPTS');
        }
    }
}
