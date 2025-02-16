<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\CoatingType;
use Illuminate\Support\Facades\DB;
use Random\RandomException;

class CoatingTypeProductSeeder extends Seeder
{
    /**
     * @throws RandomException
     */
    public function run(): void
    {
        $products = Product::all();
        $coatingTypes = CoatingType::all();

        if ($products->isEmpty() || $coatingTypes->isEmpty()) {
            $this->call([
                ProductSeeder::class,
                CoatingTypeSeeder::class,
            ]);
        }

        $data = [];

        foreach ($products as $product) {
            foreach ($coatingTypes->random(random_int(1, 3)) as $coating) {
                $data[] = [
                    'product_id' => $product->id,
                    'coating_type_id' => $coating->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('coating_type_product')->insert($data);
    }
}
