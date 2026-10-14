<?php

namespace App\Services\Shipping;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class RajaOngkirService implements ShippingServiceInterface
{
    public function getProvinces(): array
    {
        $config = config('rajaongkir');

        if (blank($config['api_key']) || $config['api_key'] === 'your_rajaongkir_api_key') {
            return app(FakeShippingService::class)->getProvinces();
        }

        return Cache::remember('rajaongkir.provinces', (int) $config['cache_ttl'], function () use ($config) {
            try {
                $response = Http::withHeaders(['key' => $config['api_key']])
                    ->timeout((int) $config['timeout'])
                    ->get($config['base_url'].'/province');

                return $response->successful()
                    ? collect($response->json('rajaongkir.results', []))->map(fn ($item) => [
                        'province_id' => (string) ($item['province_id'] ?? ''),
                        'province' => $item['province'] ?? '',
                    ])->values()->all()
                    : app(FakeShippingService::class)->getProvinces();
            } catch (\Throwable) {
                return app(FakeShippingService::class)->getProvinces();
            }
        });
    }

    public function getCities(string|int $provinceId): array
    {
        $config = config('rajaongkir');

        if (blank($config['api_key']) || $config['api_key'] === 'your_rajaongkir_api_key') {
            return app(FakeShippingService::class)->getCities($provinceId);
        }

        return Cache::remember('rajaongkir.cities.'.$provinceId, (int) $config['cache_ttl'], function () use ($config, $provinceId) {
            try {
                $response = Http::withHeaders(['key' => $config['api_key']])
                    ->timeout((int) $config['timeout'])
                    ->get($config['base_url'].'/city', ['province' => $provinceId]);

                return $response->successful()
                    ? collect($response->json('rajaongkir.results', []))->map(fn ($item) => [
                        'city_id' => (string) ($item['city_id'] ?? ''),
                        'city_name' => $item['city_name'] ?? '',
                        'type' => $item['type'] ?? '',
                        'province' => $item['province'] ?? '',
                    ])->values()->all()
                    : app(FakeShippingService::class)->getCities($provinceId);
            } catch (\Throwable) {
                return app(FakeShippingService::class)->getCities($provinceId);
            }
        });
    }

    public function getDistricts(string|int $cityId): array
    {
        $config = config('rajaongkir');

        if (blank($config['api_key']) || $config['api_key'] === 'your_rajaongkir_api_key') {
            return app(FakeShippingService::class)->getDistricts($cityId);
        }

        return Cache::remember('rajaongkir.districts.'.$cityId, (int) $config['cache_ttl'], function () use ($config, $cityId) {
            try {
                $response = Http::withHeaders(['key' => $config['api_key']])
                    ->timeout((int) $config['timeout'])
                    ->get($config['base_url'].'/subdistrict', ['city' => $cityId]);

                return $response->successful()
                    ? collect($response->json('rajaongkir.results', []))->map(fn ($item) => [
                        'subdistrict_id' => (string) ($item['subdistrict_id'] ?? ''),
                        'subdistrict_name' => $item['subdistrict_name'] ?? '',
                        'city' => $item['city'] ?? '',
                    ])->values()->all()
                    : app(FakeShippingService::class)->getDistricts($cityId);
            } catch (\Throwable) {
                return app(FakeShippingService::class)->getDistricts($cityId);
            }
        });
    }

    public function calculateCost(string|int $originId, string|int $destinationId, int $weight, string $courier): array
    {
        $config = config('rajaongkir');

        if (blank($config['api_key']) || $config['api_key'] === 'your_rajaongkir_api_key') {
            return app(FakeShippingService::class)->calculateCost($originId, $destinationId, $weight, $courier);
        }

        try {
            $response = Http::withHeaders(['key' => $config['api_key']])
                ->timeout((int) $config['timeout'])
                ->post($config['base_url'].'/cost', [
                    'origin' => $originId,
                    'destination' => $destinationId,
                    'weight' => max(1, $weight),
                    'courier' => strtolower($courier),
                ]);

            $results = $response->json('rajaongkir.results.0.costs', []);

            if (! $response->successful() || empty($results)) {
                return app(FakeShippingService::class)->calculateCost($originId, $destinationId, $weight, $courier);
            }

            return collect($results)->map(function ($service) {
                $cost = $service['cost'][0] ?? null;

                return [
                    'service' => $service['service'] ?? 'REG',
                    'description' => $service['description'] ?? '',
                    'cost' => (int) ($cost['value'] ?? 0),
                    'etd' => $cost['etd'] ?? '1-2 hari',
                    'note' => $cost['note'] ?? '',
                ];
            })->values()->all();
        } catch (\Throwable) {
            return app(FakeShippingService::class)->calculateCost($originId, $destinationId, $weight, $courier);
        }
    }

    public function getCost(string $destinationCityId, string $courier = 'jne', int $weight = 1000): array
    {
        return $this->calculateCost(config('rajaongkir.origin_id', '152'), $destinationCityId, $weight, $courier);
    }

    public function getCouriers(): array
    {
        return config('rajaongkir.couriers', ['jne', 'pos', 'tiki']);
    }

    public function testConnection(): bool
    {
        return $this->getProvinces() !== [];
    }
}
