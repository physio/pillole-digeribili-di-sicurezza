<?php

namespace App\Guardian\Providers;

use Cache;
use Illuminate\Support\Facades\Http;

class IpLookup {

    private function lookup(string $ip): array
    {
        if (Cache::has($ip)) {
            return json_decode(Cache::get($ip), true);
        }

        $key = env('IPAPI_KEY');

        $payload = Http::get("https://api.ipapi.com/api/{$ip}?access_key={$key}")->json();

        Cache::put($ip, json_encode($payload));

        return $payload;
    }
}