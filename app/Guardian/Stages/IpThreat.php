<?php

namespace App\Guardian\Stages;

use Carbon\Carbon;
use App\Models\Action;
use App\Guardian\Contracts\Stage;
use App\Guardian\Data;
use App\Guardian\ActionsRepository;

class IpThreat implements Stage {
    private $actions;

    private $ip;

    function __construct(ActionsRepository $actions, IpLookup $ip)
    {
        $this->actions = $actions;

        $this->ip = $ip;
    }

    public function run(Data $data): bool
    {
        if ($data->logged()) {
            return false;
        }

        $payload = (object) $this->ip->lookup($data->ip());
       
        return $payload->is_proxy || $payload->is_tor || $payload->threat_level == 'high';
    }
}