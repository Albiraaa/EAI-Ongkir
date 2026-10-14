<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ShippingSettingsController extends Controller
{
    public function index()
    {
        $settings = [
            'base_url' => config('rajaongkir.base_url'),
            'api_key' => config('rajaongkir.api_key'),
            'origin_id' => config('rajaongkir.origin_id'),
            'couriers' => config('rajaongkir.couriers'),
            'timeout' => config('rajaongkir.timeout'),
        ];

        return view('admin.shipping-settings', compact('settings'));
    }
}
