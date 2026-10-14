<?php

namespace App\Providers;

use App\Services\Shipping\FakeShippingService;
use App\Services\Shipping\RajaOngkirService;
use App\Services\Shipping\ShippingServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ShippingServiceInterface::class, function () {
            $driver = config('rajaongkir.driver', 'rajaongkir');

            return $driver === 'fake'
                ? new FakeShippingService
                : new RajaOngkirService;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
