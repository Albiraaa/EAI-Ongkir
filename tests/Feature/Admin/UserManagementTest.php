<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_customer_management_page(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get(route('admin.customers.index'));

        $response->assertOk();
    }

    public function test_admin_can_update_customer_role(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $customer = User::factory()->create(['role' => 'customer']);

        $response = $this->actingAs($admin)->patch(route('admin.customers.update', $customer), [
            'name' => $customer->name,
            'email' => $customer->email,
            'phone' => '081234567890',
            'address' => 'Jakarta',
            'role' => 'admin',
        ]);

        $response->assertRedirect(route('admin.customers.index'));
        $this->assertDatabaseHas('users', [
            'id' => $customer->id,
            'role' => 'admin',
        ]);
    }

    public function test_admin_can_delete_user_account(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $customer = User::factory()->create(['role' => 'customer']);

        $response = $this->actingAs($admin)->delete(route('admin.customers.destroy', $customer));

        $response->assertRedirect(route('admin.customers.index'));
        $this->assertDatabaseMissing('users', ['id' => $customer->id]);
    }
}
