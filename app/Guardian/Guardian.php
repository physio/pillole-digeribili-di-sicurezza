<?php

namespace App\Guardian;

use App\Guardian\Data;

class Guardian {    
    private $data;

    function __construct()
    {
        $this->data = new Data();
    }

    public function login(): void
    {
        $threshold = 0;

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