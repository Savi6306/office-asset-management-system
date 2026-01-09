<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Asset;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@oams.com',
            'password' => bcrypt('password'),
        ]);

        // Create categories
        $categories = ['Electronics', 'Furniture', 'IT Equipment', 'Office Supplies'];
        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }

        // Create sample assets
        Asset::create([
            'category_id' => 1,
            'name' => 'Dell Laptop',
            'serial_number' => 'DL-001',
            'status' => 'Assigned',
        ]);

        Asset::create([
            'category_id' => 1,
            'name' => 'HP Monitor',
            'serial_number' => 'HP-001',
            'status' => 'Available',
        ]);

        Asset::create([
            'category_id' => 2,
            'name' => 'Office Chair',
            'serial_number' => 'OC-001',
            'status' => 'Available',
        ]);
    }
}