<?php

return [
    'enabled' => env('CLOUDFLARE_ENABLED', true),
    'api_key' => env('CLOUDFLARE_API_KEY'),
    'email' => env('CLOUDFLARE_EMAIL'),
    'zone_id' => env('CLOUDFLARE_ZONE_ID'),
    'allowed_countries' => ['BR', 'US'],
    'blocked_ips' => [
        // IPs bloqueados
    ],
]; 