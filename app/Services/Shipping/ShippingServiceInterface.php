<?php

namespace App\Services\Shipping;

interface ShippingServiceInterface
{
    public function getProvinces(): array;

    public function getCities(string|int $provinceId): array;

    public function getDistricts(string|int $cityId): array;

    public function calculateCost(string|int $originId, string|int $destinationId, int $weight, string $courier): array;

    public function getCouriers(): array;

    public function testConnection(): bool;
}
