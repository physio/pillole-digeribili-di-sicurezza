<?php

namespace App\Guardian;

class Guardian {    
    public function login(string $fingerpint, array $data, bool $failed): void
    {
        $threshold = 0;

        foreach(config('pills.stages') as $class => $weight) {
            $stage = resolve($class);

            if ($stage->run($fingerpint, $data)) {
                $threshold += $weight;
            }
        }

        if ($threshold > config('pills.threshold')) {
            // Notification & Action
        }
    }
}