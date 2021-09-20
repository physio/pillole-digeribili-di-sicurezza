<?php

namespace App\Guardian\Stages;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use App\Models\Action;
use App\Guardian\Contracts\Stage;
use App\Guardian\Data;
use App\Guardian\ActionsRepository;

class AsnLookup implements Stage {
    private $actions;

    function __construct(ActionsRepository $actions)
    {
        $this->actions = $actions;
    }

    public function run(Data $data): bool
    {
        if ($data->logged()) {
            return false;
        }

        $key = env('IPAPI_KEY');

        $payload = Http::get("https://api.ipapi.com/api/{$data->ip()}?access_key={$key}")->json();

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