<?php

namespace App\Guardian\Stages;

use Carbon\Carbon;
use App\Models\Action;
use App\Guardian\Contracts\Stage;
use App\Guardian\LoginData;
use App\Guardian\ActionsRepository;
use App\Guardian\Providers\IpLookup;
use Illuminate\Support\Facades\Log;

class AsnLookup implements Stage
{
    private $actions;

    private $ip;

    function __construct(ActionsRepository $actions, IpLookup $ip)
    {
        $this->actions = $actions;

        $this->ip = $ip;
    }

    public function run(LoginData $data): bool
    {
        $payload = (object) $this->ip->lookup($data->ip());

        if (!$payload->success) {
            Log::warning('Error connecting to security api (key is not present?)');

            return false;
        }

        $this->actions->create(AsnLookup::class, $payload->connection->asn);

        $logins = $this->actions->action(AsnLookup::class)
            ->orderBy('created_at', 'desc')
            ->take(2);

        if (count($logins) < 2) {
            return false;
        }

        return $logins[0]->data != $logins[1]->data;
    }
}
