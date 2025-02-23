<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\CoatingType;
use Illuminate\Support\Facades\DB;
use Random\RandomException;

class CoatingTypeProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();
        $coatingTypes = CoatingType::all();

        if ($products->isEmpty() || $coatingTypes->isEmpty()) {
            $this->call([
                ProductSeeder::class,
                CoatingTypeSeeder::class,
            ]);

            $products = Product::all();
            $coatingTypes = CoatingType::all();
        }

        $products->each(/**
         * @throws RandomException
         */ function($product) use ($coatingTypes) {
            $randomCoatings = $coatingTypes->random(random_int(1, 3));
            $product->coatingTypes()->attach($randomCoatings->pluck('id')->toArray());
        });
    }
}
