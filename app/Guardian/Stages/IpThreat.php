<?php

namespace App\Guardian\Stages;

use Carbon\Carbon;
use App\Models\Action;
use App\Guardian\Contracts\Stage;
use App\Guardian\LoginData;
use App\Guardian\ActionsRepository;
use App\Guardian\Providers\IpLookup;
use Illuminate\Support\Facades\Log;

class IpThreat implements Stage {
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

        $this->actions->create(IpThreat::class, "proxy: {$payload->is_proxy}, tor: {$payload->is_tor}, level: {$payload->threat_level}" );

        return $payload->is_proxy || $payload->is_tor || $payload->threat_level == 'high';
    }
}
