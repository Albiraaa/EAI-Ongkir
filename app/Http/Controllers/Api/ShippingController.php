<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Shipping\ShippingServiceInterface;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function __construct(protected ShippingServiceInterface $shippingService)
    {
    }

    public function provinces(): \Illuminate\Http\JsonResponse
    {
        return $this->successResponse($this->shippingService->getProvinces(), 'Provinces loaded successfully.');
    }

    public function cities(Request $request, string $provinceId): \Illuminate\Http\JsonResponse
    {
        $data = $this->shippingService->getCities($provinceId);

        return $this->successResponse($data, 'Cities loaded successfully.');
    }

    public function districts(Request $request, string $cityId): \Illuminate\Http\JsonResponse
    {
        $data = $this->shippingService->getDistricts($cityId);

        return $this->successResponse($data, 'Districts loaded successfully.');
    }

    public function cost(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'origin_id' => ['required', 'string'],
            'destination_id' => ['required', 'string'],
            'weight' => ['required', 'integer', 'min:1'],
            'courier' => ['nullable', 'string'],
        ]);

        $options = $this->shippingService->calculateCost(
            $request->input('origin_id'),
            $request->input('destination_id'),
            (int) $request->input('weight', 1000),
            $request->input('courier', 'jne')
        );

        return $this->successResponse($options, 'Shipping cost fetched successfully.');
    }

    public function check(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'destination_city_id' => ['sometimes', 'string'],
            'destination_id' => ['sometimes', 'string'],
            'weight' => ['nullable', 'integer', 'min:1'],
            'courier' => ['nullable', 'string'],
        ]);

        $destinationId = $request->input('destination_id', $request->input('destination_city_id', '1'));
        $courier = $request->input('courier', 'jne');
        $weight = (int) $request->input('weight', 1000);

        $options = $this->shippingService->calculateCost(
            config('rajaongkir.origin_id', '152'),
            $destinationId,
            $weight,
            $courier
        );

        return $this->successResponse($options, 'Shipping options fetched successfully.');
    }

    protected function successResponse(array $data, string $message): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ]);
    }
}
