<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Marketplace',
            'email' => 'admin@marketplaceongkir.test',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Jl. Merdeka No. 1, Bandung',
        ]);

        User::create([
            'name' => 'Customer Demo',
            'email' => 'customer@marketplaceongkir.test',
            'password' => bcrypt('password123'),
            'role' => 'customer',
            'phone' => '082345678901',
            'address' => 'Jl. Raya Cibubur No. 12, Jakarta',
        ]);

        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}
