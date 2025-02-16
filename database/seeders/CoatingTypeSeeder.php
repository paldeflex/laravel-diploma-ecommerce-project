<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CoatingType;

class CoatingTypeSeeder extends Seeder
{
    public function run(): void
    {
        CoatingType::factory()->count(8)->create();
    }
}
