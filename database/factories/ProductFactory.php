<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'name' => $this->faker->sentence(3),
            'slug' => Str::slug($this->faker->sentence(3)),
            'description' => $this->faker->paragraph(),
            'images' => [],
            'price' => $this->faker->randomFloat(2, 500, 5000),
            'is_active' => $this->faker->boolean(),
            'is_featured' => $this->faker->boolean(),
            'in_stock' => $this->faker->boolean(),
            'on_sale' => $this->faker->boolean(),
        ];
    }
}
