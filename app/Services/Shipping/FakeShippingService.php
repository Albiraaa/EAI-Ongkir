<?php

namespace App\Services\Shipping;

class FakeShippingService implements ShippingServiceInterface
{
    public function getProvinces(): array
    {
        return [
            ['province_id' => '1', 'province' => 'DKI Jakarta'],
            ['province_id' => '2', 'province' => 'Jawa Barat'],
            ['province_id' => '3', 'province' => 'Jawa Tengah'],
            ['province_id' => '4', 'province' => 'Jawa Timur'],
        ];
    }

    public function getCities(string|int $provinceId): array
    {
        $cities = [
            '1' => [
                ['city_id' => '152', 'city_name' => 'Jakarta Selatan', 'type' => 'Kota', 'province' => 'DKI Jakarta'],
                ['city_id' => '153', 'city_name' => 'Jakarta Pusat', 'type' => 'Kota', 'province' => 'DKI Jakarta'],
            ],
            '2' => [
                ['city_id' => '23', 'city_name' => 'Bandung', 'type' => 'Kota', 'province' => 'Jawa Barat'],
                ['city_id' => '24', 'city_name' => 'Bogor', 'type' => 'Kota', 'province' => 'Jawa Barat'],
            ],
            '3' => [
                ['city_id' => '31', 'city_name' => 'Semarang', 'type' => 'Kota', 'province' => 'Jawa Tengah'],
                ['city_id' => '32', 'city_name' => 'Solo', 'type' => 'Kota', 'province' => 'Jawa Tengah'],
            ],
            '4' => [
                ['city_id' => '42', 'city_name' => 'Surabaya', 'type' => 'Kota', 'province' => 'Jawa Timur'],
                ['city_id' => '43', 'city_name' => 'Malang', 'type' => 'Kota', 'province' => 'Jawa Timur'],
            ],
        ];

        return $cities[(string) $provinceId] ?? [];
    }

    public function getDistricts(string|int $cityId): array
    {
        $districts = [
            '152' => [
                ['subdistrict_id' => '1101', 'subdistrict_name' => 'Kebayoran Baru'],
                ['subdistrict_id' => '1102', 'subdistrict_name' => 'Kebayoran Lama'],
            ],
            '23' => [
                ['subdistrict_id' => '2301', 'subdistrict_name' => 'Cibeunying'],
                ['subdistrict_id' => '2302', 'subdistrict_name' => 'Bandung Wetan'],
            ],
            '42' => [
                ['subdistrict_id' => '4201', 'subdistrict_name' => 'Genteng'],
                ['subdistrict_id' => '4202', 'subdistrict_name' => 'Wonokromo'],
            ],
        ];

        return $districts[(string) $cityId] ?? [
            ['subdistrict_id' => (string) $cityId.'01', 'subdistrict_name' => 'Area Demo'],
        ];
    }

    public function calculateCost(string|int $originId, string|int $destinationId, int $weight, string $courier): array
    {
        $multiplier = match (strtolower($courier)) {
            'jne' => 1200,
            'pos' => 1000,
            'tiki' => 1400,
            'jnt' => 1300,
            'sicepat' => 1600,
            default => 1100,
        };

        $baseCost = (int) ceil(($weight / 1000) * $multiplier * 8);

        return [
            [
                'service' => 'REG',
                'description' => 'Layanan reguler demo',
                'cost' => $baseCost + 3000,
                'etd' => '2-3 hari',
                'note' => 'Estimasi demo dari FakeShippingService',
            ],
            [
                'service' => 'YES',
                'description' => 'Layanan cepat demo',
                'cost' => $baseCost + 7000,
                'etd' => '1-2 hari',
                'note' => 'Pilihan cepat untuk pengiriman segera',
            ],
        ];
    }

    public function getCouriers(): array
    {
        return ['jne', 'pos', 'tiki', 'jnt', 'sicepat'];
    }

    public function testConnection(): bool
    {
        return true;
    }
}
