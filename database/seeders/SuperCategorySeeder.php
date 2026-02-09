<?php

namespace Database\Seeders;

use App\Models\SuperCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuperCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superCategories = [
            [
                'name' => 'Men',
                'slug' => 'men',
                'description' => 'Premium timepieces designed for the modern gentleman',
            ],
            [
                'name' => 'Women',
                'slug' => 'women',
                'description' => 'Elegant watches crafted for sophisticated women',
            ],
            [
                'name' => 'Smart Watches',
                'slug' => 'smart-watches',
                'description' => 'Cutting-edge smartwatches combining technology and style',
            ],
        ];

        foreach ($superCategories as $category) {
            SuperCategory::create($category);
        }
    }
}
