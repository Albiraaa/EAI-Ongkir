<?php

namespace Tests\Feature;

use Tests\TestCase;

class MarketplaceTest extends TestCase
{
    public function test_home_page_loads(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Marketplace Ongkir');
    }

    public function test_shipping_cost_endpoint_returns_fake_data(): void
    {
        config()->set('rajaongkir.driver', 'fake');

        $this->postJson('/api/shipping/cost', [
            'origin_id' => '152',
            'destination_id' => '1',
            'weight' => 1000,
            'courier' => 'jne',
        ])->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    '*' => [
                        'service',
                        'description',
                        'cost',
                        'etd',
                    ],
                ],
            ]);
    }
}
