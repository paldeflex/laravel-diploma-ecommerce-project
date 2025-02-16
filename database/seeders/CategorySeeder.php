<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Антикоррозионные материалы и покрытия',
            'Защита от подземной коррозии',
            'Защита бетона',
            'Огнезащитные покрытия',
        ];

        foreach ($categories as $categoryName) {
            Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
                'image' => null,
                'is_active' => true,
            ]);
        }
    }
}
