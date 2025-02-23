<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'user_id'         => User::factory(),
            'grand_total'     => $this->faker->randomFloat(2, 50, 500),
            'payment_method'  => $this->faker->randomElement(['yookassa', 'cod']),
            'payment_status'  => $this->faker->randomElement(['pending', 'paid', 'failed']),
            'status'          => $this->faker->randomElement(['new', 'processing', 'shipped', 'delivered', 'canceled']),
            'shipping_amount' => $this->faker->randomFloat(2, 0, 50),
            'shipping_method' => $this->faker->randomElement(['post_office', 'sdek', 'boxberry', 'yandex_market']),
            'notes'           => $this->faker->sentence,
        ];
    }
}
