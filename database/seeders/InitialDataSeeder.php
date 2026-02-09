<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InitialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Rolex', 'image' => 'https://images.unsplash.com/photo-1587839622661-f2e030422f5e?w=800'],
            ['name' => 'Omega', 'image' => 'https://images.unsplash.com/photo-1614164185128-e4ec99c436d7?w=800'],
            ['name' => 'Patek Philippe', 'image' => 'https://images.unsplash.com/photo-1619134778706-7015533a6150?w=800'],
            ['name' => 'Audemars Piguet', 'image' => 'https://images.unsplash.com/photo-1547996160-81dfa63595ee?w=800'],
        ];

        foreach ($categories as $cat) {
            $category = \App\Models\Category::create($cat);

            if ($cat['name'] == 'Rolex') {
                \App\Models\Product::create([
                    'category_id' => $category->id,
                    'name' => 'Submariner',
                    'brand' => 'Rolex',
                    'price' => 12500,
                    'stock_quantity' => 5,
                    'description' => 'The quintessential divers watch, the Submariner is a reference among dive watches.',
                    'images' => ['https://images.unsplash.com/photo-1587839622661-f2e030422f5e?w=800']
                ]);
            }
            if ($cat['name'] == 'Omega') {
                \App\Models\Product::create([
                    'category_id' => $category->id,
                    'name' => 'Seamaster',
                    'brand' => 'Omega',
                    'price' => 6200,
                    'stock_quantity' => 10,
                    'description' => 'The OMEGA Seamaster 300 is one of the world\'s most famous dive watches.',
                    'images' => ['https://images.unsplash.com/photo-1614164185128-e4ec99c436d7?w=800']
                ]);
            }
        }
    }
}
