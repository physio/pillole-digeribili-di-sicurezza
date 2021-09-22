<?php

namespace App\Guardian;

use Illuminate\Support\Facades\Auth;
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
        $userId = 0;

        if (Auth::check()) {
            $userId = Auth::user()->id;
        }

        return Action::create([
            'user_id' => $userId,
            'fingerprint' => $this->data->fingerprint(),
            'action' => $action,
            'data' => $data ?? $this->data->ip()
        ]);
    }

    public function action(string $action)
    {
        return Action::where('fingerprint', $this->data->fingerprint())
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
