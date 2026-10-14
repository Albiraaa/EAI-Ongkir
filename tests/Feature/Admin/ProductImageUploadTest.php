<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductImageUploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_upload_product_image_when_creating_product(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::create([
            'name' => 'Elektronik',
            'slug' => 'elektronik',
            'description' => 'Barang elektronik',
        ]);

        $response = $this->actingAs($admin)->post(route('admin.products.store'), [
            'category_id' => $category->id,
            'name' => 'Laptop Baru',
            'slug' => 'laptop-baru',
            'description' => 'Laptop terbaru',
            'price' => 12000000,
            'compare_price' => 15000000,
            'stock' => 10,
            'image' => UploadedFile::fake()->create('laptop.jpg', 100, 'image/jpeg'),
            'featured' => true,
            'status' => 'active',
        ]);

        $response->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseHas('products', [
            'name' => 'Laptop Baru',
            'featured' => true,
        ]);

        $product = \App\Models\Product::first();
        $this->assertNotNull($product?->image);

        $disk = Storage::disk('public');
        $this->assertTrue($disk->exists($product->image));
    }

    public function test_admin_can_delete_existing_product_image_without_removing_product(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::create([
            'name' => 'Elektronik',
            'slug' => 'elektronik',
            'description' => 'Barang elektronik',
        ]);

        $product = \App\Models\Product::create([
            'category_id' => $category->id,
            'name' => 'Mouse Wireless',
            'slug' => 'mouse-wireless',
            'description' => 'Mouse tanpa kabel',
            'price' => 250000,
            'compare_price' => 300000,
            'stock' => 8,
            'image' => 'products/mouse.jpg',
            'featured' => false,
            'status' => 'active',
        ]);

        Storage::disk('public')->put($product->image, 'fake-image-content');

        $response = $this->actingAs($admin)->delete(route('admin.products.remove-image', $product));

        $response->assertRedirect(route('admin.products.edit', $product));
        $this->assertDatabaseHas('products', ['id' => $product->id, 'image' => null]);
        $this->assertFalse(Storage::disk('public')->exists($product->image));
    }
}
