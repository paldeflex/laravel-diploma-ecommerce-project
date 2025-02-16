<?php

namespace Database\Factories;

use App\Models\CoatingType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CoatingType>
 */
class CoatingTypeFactory extends Factory
{

    protected $model = CoatingType::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'slug' => Str::slug($this->faker->word()),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
