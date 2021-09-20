<?php

namespace App\Guardian;

use App\Guardian\LoginData;
use App\Models\Action;

class ActionsRepository {    
    private $data;

    function __construct(LoginData $data)
    {
        $this->data = $data;
    }

    public function create(string $action, string $data = null): Action
    {
        return Action::create([
            'fingerprint' => $this->data->fingerpint(),
            'action' => 'success',
            'data' => $data ?? $this->data->ip()
        ]);
    }

    public function action(string $action)
    {
        return Action::where('fingerprint', $data->fingerpint())
            ->where('action', $action);
    }

    public function lastTwo(string $action): ?array
    {
        $logins = $this->action($action)
            ->orderBy('created_at', 'desc')
            ->take(2);

        if (count($logins) < 2) {
            return null;
        }
            
        return [ $logins[0], $logins[1] ];
    }
}