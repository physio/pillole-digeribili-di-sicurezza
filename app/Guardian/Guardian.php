<?php

namespace App\Guardian;

use App\Guardian\LoginData;

class Guardian {    
    private $data;

    function __construct()
    {
        $this->data = new LoginData();
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