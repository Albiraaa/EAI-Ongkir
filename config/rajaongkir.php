<?php

return [
    'driver' => env('SHIPPING_DRIVER', 'rajaongkir'),
    'base_url' => env('RAJAONGKIR_BASE_URL', 'https://pro.rajaongkir.com/api'),
    'api_key' => env('RAJAONGKIR_API_KEY', 'your_rajaongkir_api_key'),
    'origin_id' => env('RAJAONGKIR_ORIGIN_ID', '152'),
    'couriers' => array_values(array_filter(array_map('trim', explode(',', env('RAJAONGKIR_COURIERS', 'jne,pos,tiki'))))),
    'timeout' => env('RAJAONGKIR_TIMEOUT', 30),
    'cache_ttl' => env('RAJAONGKIR_CACHE_TTL', 86400),
];
