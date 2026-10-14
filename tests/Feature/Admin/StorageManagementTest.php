<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StorageManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_storage_management_page(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get(route('admin.storage.index'));

        $response->assertOk();
        $response->assertViewIs('admin.storage.index');
    }

    public function test_admin_can_upload_image_to_storage_management(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post(route('admin.storage.upload'), [
            'files' => [
                UploadedFile::fake()->create('banner.jpg', 120, 'image/jpeg'),
            ],
        ]);

        $response->assertRedirect(route('admin.storage.index'));
        $this->assertNotEmpty(Storage::disk('public')->allFiles('uploads'));
    }

    public function test_admin_can_delete_image_from_storage_management(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create(['role' => 'admin']);
        $path = 'uploads/delete-me.jpg';
        Storage::disk('public')->put($path, 'fake-image-content');

        $response = $this->actingAs($admin)->delete(route('admin.storage.destroy', ['path' => $path]));

        $response->assertRedirect(route('admin.storage.index'));
        $this->assertFalse(Storage::disk('public')->exists($path));
    }
}
