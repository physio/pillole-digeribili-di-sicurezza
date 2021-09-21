<?php

namespace App\Guardian\Stages;

use Carbon\Carbon;
use App\Models\Action;
use App\Guardian\Contracts\Stage;
use App\Guardian\LoginData;
use App\Guardian\ActionsRepository;

class AsnLookup implements Stage {
    private $actions;

    private $ip;

    function __construct(ActionsRepository $actions, IpLookup $ip)
    {
        $this->actions = $actions;

        $this->ip = $ip;
    }

    public function run(LoginData $data): bool
    {
        if ($data->logged()) {
            return false;
        }

        $payload = (object) $this->ip->lookup($data->ip());

        $this->create(AsnLookup::class, $payload->connection->asn);

        $logins = $this->action(AsnLookup::class)
            ->orderBy('created_at', 'desc')
            ->take(2);

        if (count($logins) < 2) {
            return false;
        }
        
        return $logins[0]->data != $logins[1]->data;
    }
}