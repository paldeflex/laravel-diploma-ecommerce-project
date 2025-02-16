<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::pluck('id', 'name');

        if ($categories->isEmpty()) {
            $this->call(CategorySeeder::class);
            $categories = Category::pluck('id', 'name');
        }

        $products = [
            ['name' => 'Грунтовка эпоксидная антикоррозионная', 'category' => 'Антикоррозионные материалы и покрытия', 'price' => 1200.50],
            ['name' => 'Покрытие полиуретановое защитное', 'category' => 'Защита от подземной коррозии', 'price' => 2300.00],
            ['name' => 'Пропитка для бетона усиленная', 'category' => 'Защита бетона', 'price' => 1500.75],
            ['name' => 'Огнезащитная краска для металла', 'category' => 'Огнезащитные покрытия', 'price' => 3400.99],
        ];

        foreach ($products as $product) {
            Product::create([
                'category_id' => $categories[$product['category']],
                'name' => $product['name'],
                'slug' => Str::slug($product['name']),
                'description' => 'Описание продукта '.$product['name'],
                'images' => [],
                'price' => $product['price'],
                'is_active' => true,
                'is_featured' => false,
                'in_stock' => true,
                'on_sale' => false,
            ]);
        }
    }
}
