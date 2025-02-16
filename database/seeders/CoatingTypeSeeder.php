<?php

namespace Database\Seeders;

use App\Models\CoatingType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CoatingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coatingTypes = [
            'Полиуретановая',
            'Цинконаполненная',
            'Алкидною-уретановая',
            'Пенетрирующая',
            'Эпоксидный состав',
            'Органоразбовляемый модифицированный сополимер',
            'Акриловая',
            'Огнезащитная',
        ];

        foreach ($coatingTypes as $typeName) {
            CoatingType::create([
                'name' => $typeName,
                'slug' => Str::slug($typeName),
                'is_active' => true,
            ]);
        }
    }
}
