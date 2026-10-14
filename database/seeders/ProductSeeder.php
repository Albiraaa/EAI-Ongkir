<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['category' => 'Elektronik', 'name' => 'Smartwatch Pro 5', 'price' => 2499000, 'compare_price' => 3299000, 'stock' => 18, 'featured' => true, 'description' => 'Smartwatch dengan monitor kesehatan dan konektivitas Bluetooth.', 'image' => 'https://images.unsplash.com/photo-1546868871-7041f2a55e12?auto=format&fit=crop&w=900&q=80'],
            ['category' => 'Elektronik', 'name' => 'Earbuds Sonic X', 'price' => 1299000, 'compare_price' => 1799000, 'stock' => 30, 'featured' => true, 'description' => 'Earbuds dengan kualitas suara premium dan daya tahan baterai tinggi.', 'image' => 'https://images.unsplash.com/photo-1546435770-a3e426bf472b?auto=format&fit=crop&w=900&q=80'],
            ['category' => 'Elektronik', 'name' => 'Laptop Aero 14', 'price' => 8990000, 'compare_price' => 10990000, 'stock' => 12, 'featured' => true, 'description' => 'Laptop ringan dan cepat untuk kerja sehari-hari.', 'image' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?auto=format&fit=crop&w=900&q=80'],
            ['category' => 'Fashion', 'name' => 'Jaket Urban Lite', 'price' => 499000, 'compare_price' => 699000, 'stock' => 22, 'featured' => false, 'description' => 'Jaket santai dengan bahan ringan dan nyaman dipakai harian.', 'image' => 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?auto=format&fit=crop&w=900&q=80'],
            ['category' => 'Fashion', 'name' => 'Sneaker Flex Motion', 'price' => 699000, 'compare_price' => 899000, 'stock' => 20, 'featured' => true, 'description' => 'Sepatu trendi dengan desain sporty dan bahan empuk.', 'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=900&q=80'],
            ['category' => 'Fashion', 'name' => 'Tas Traveler Mini', 'price' => 399000, 'compare_price' => 550000, 'stock' => 18, 'featured' => false, 'description' => 'Tas dengan kapasitas cukup untuk kebutuhan harian.', 'image' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?auto=format&fit=crop&w=900&q=80'],
            ['category' => 'Home & Living', 'name' => 'Lampu Tidur Minimalis', 'price' => 289000, 'compare_price' => 420000, 'stock' => 25, 'featured' => false, 'description' => 'Lampu estetis untuk ruang tidur dan area kerja.', 'image' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=900&q=80'],
            ['category' => 'Home & Living', 'name' => 'Bantal Comfort Plus', 'price' => 180000, 'compare_price' => 250000, 'stock' => 40, 'featured' => false, 'description' => 'Bantal nyaman untuk kualitas tidur lebih baik.', 'image' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=900&q=80'],
            ['category' => 'Olahraga', 'name' => 'Treadmill Compact', 'price' => 5490000, 'compare_price' => 6299000, 'stock' => 7, 'featured' => true, 'description' => 'Alat latihan rumah dengan desain compact dan aman.', 'image' => 'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?auto=format&fit=crop&w=900&q=80'],
            ['category' => 'Olahraga', 'name' => 'Botol Minum Sport', 'price' => 140000, 'compare_price' => 180000, 'stock' => 50, 'featured' => false, 'description' => 'Botol minum anti tumpah untuk aktivitas luar ruangan.', 'image' => 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?auto=format&fit=crop&w=900&q=80'],
            ['category' => 'Kecantikan', 'name' => 'Skincare Glow Serum', 'price' => 260000, 'compare_price' => 340000, 'stock' => 35, 'featured' => true, 'description' => 'Serum dengan formula ringan untuk kulit cerah dan sehat.', 'image' => 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?auto=format&fit=crop&w=900&q=80'],
            ['category' => 'Kecantikan', 'name' => 'Brush Clean Kit', 'price' => 210000, 'compare_price' => 260000, 'stock' => 28, 'featured' => false, 'description' => 'Kit pembersih brush untuk perawatan harian yang lebih praktis.', 'image' => 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?auto=format&fit=crop&w=900&q=80'],
        ];

        foreach ($products as $product) {
            $category = Category::where('name', $product['category'])->firstOrFail();

            Product::create([
                'category_id' => $category->id,
                'name' => $product['name'],
                'slug' => Str::slug($product['name']),
                'description' => $product['description'],
                'price' => $product['price'],
                'compare_price' => $product['compare_price'],
                'stock' => $product['stock'],
                'image' => $product['image'],
                'featured' => $product['featured'],
                'status' => 'active',
            ]);
        }
    }
}
