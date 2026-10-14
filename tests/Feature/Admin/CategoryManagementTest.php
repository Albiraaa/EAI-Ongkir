<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CategoryManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_update_existing_category(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::create([
            'name' => 'Elektronik',
            'slug' => 'elektronik',
            'description' => 'Old description',
        ]);

        $response = $this->actingAs($admin)->patch(route('admin.categories.update', $category), [
            'name' => 'Elektronik Update',
            'description' => 'New description',
        ]);

        $response->assertRedirect(route('admin.categories.index'));
        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Elektronik Update',
            'slug' => 'elektronik-update',
        ]);
    }

    public function test_admin_can_update_category_image(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::create([
            'name' => 'Elektronik',
            'slug' => 'elektronik',
            'description' => 'Old description',
        ]);

        $response = $this->actingAs($admin)->patch(route('admin.categories.update', $category), [
            'name' => 'Elektronik',
            'description' => 'Updated description',
            'image' => UploadedFile::fake()->create('category.jpg', 120, 'image/jpeg'),
        ]);

        $response->assertRedirect(route('admin.categories.index'));
        $this->assertDatabaseHas('categories', ['id' => $category->id, 'name' => 'Elektronik']);

        $category->refresh();
        $this->assertNotNull($category->image);

        $disk = Storage::disk('public');
        $this->assertTrue($disk->exists($category->image));
    }

    public function test_admin_can_delete_category_image_without_removing_category(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::create([
            'name' => 'Pakaian',
            'slug' => 'pakaian',
            'description' => 'Barang pakaian',
            'image' => 'categories/test-category.jpg',
        ]);

        Storage::disk('public')->put($category->image, 'fake-image-content');

        $response = $this->actingAs($admin)->delete(route('admin.categories.remove-image', $category));

        $response->assertRedirect(route('admin.categories.edit', $category));
        $this->assertDatabaseHas('categories', ['id' => $category->id, 'image' => null]);
        $this->assertFalse(Storage::disk('public')->exists($category->image));
    }

    public function test_admin_can_delete_category(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::create([
            'name' => 'Pakaian',
            'slug' => 'pakaian',
            'description' => 'Barang pakaian',
        ]);

        $response = $this->actingAs($admin)->delete(route('admin.categories.destroy', $category));

        $response->assertRedirect(route('admin.categories.index'));
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
