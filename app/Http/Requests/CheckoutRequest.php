<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'shipping_name' => ['required', 'string', 'max:255'],
            'shipping_phone' => ['required', 'string', 'max:30'],
            'shipping_address' => ['required', 'string', 'max:500'],
            'shipping_city_id' => ['required', 'string'],
            'shipping_city_name' => ['required', 'string'],
            'shipping_courier' => ['required', 'string'],
            'shipping_service' => ['required', 'string'],
            'shipping_cost' => ['required', 'numeric', 'min:0'],
        ];
    }
}
