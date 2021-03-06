<?php

namespace App\Guardian\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class IpLookup {
    public function lookup(string $ip): array
    {
        if (Cache::has($ip)) {
            return json_decode(Cache::get($ip), true);
        }

        $key = env('IPAPI_KEY');

        $payload = Http::get("http://api.ipapi.com/api/{$ip}?access_key={$key}")->json();

        Cache::put($ip, json_encode($payload));

        return $payload;
    }
}
