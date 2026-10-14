<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Elektronik', 'description' => 'Perangkat digital, audio, dan gadget modern.'],
            ['name' => 'Fashion', 'description' => 'Pakaian premium dan gaya yang selalu up to date.'],
            ['name' => 'Home & Living', 'description' => 'Perabot rumah dan kebutuhan sehari-hari yang nyaman.'],
            ['name' => 'Olahraga', 'description' => 'Peralatan olahraga untuk gaya hidup aktif.'],
            ['name' => 'Kecantikan', 'description' => 'Produk perawatan diri dan kecantikan.'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'image' => 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?auto=format&fit=crop&w=900&q=80',
            ]);
        }
    }
}
