<?php

namespace Database\Seeders;

use App\Models\CoatingType;
use Illuminate\Database\Seeder;

class CoatingTypeSeeder extends Seeder
{
    public function run(): void
    {
        CoatingType::factory()->count(8)->create();
    }
}
