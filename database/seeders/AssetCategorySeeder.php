<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class AssetCategorySeeder extends Seeder
{
    public function run(): void
    {
        // Purana data delete karne ke liye (Optional)
        Category::truncate();

        $categories = [
            ['name' => 'Electronics'],
            ['name' => 'Furniture'],
            ['name' => 'IT Equipment'],
            ['name' => 'Office Supplies'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}