<?php

namespace Database\Seeders;

use App\Models\CoatingType;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Random\RandomException;

class CoatingTypeProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @throws RandomException
     */
    public function run(): void
    {
        $products = Product::pluck('id')->toArray();
        $coatingTypes = CoatingType::pluck('id')->toArray();

        if (empty($products) || empty($coatingTypes)) {
            $this->call([
                ProductSeeder::class,
                CoatingTypeSeeder::class,
            ]);

            $products = Product::pluck('id')->toArray();
            $coatingTypes = CoatingType::pluck('id')->toArray();
        }

        $data = [];
        $coatingCount = count($coatingTypes);

        foreach ($products as $index => $productId) {
            $startIndex = ($index * 2) % $coatingCount;
            $coverCount = random_int(1, 3);
            foreach (array_slice($coatingTypes, $startIndex, $coverCount) as $coatingId) {
                $data[] = [
                    'product_id' => $productId,
                    'coating_type_id' => $coatingId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }


        DB::table('coating_type_product')->insert($data);
    }
}
