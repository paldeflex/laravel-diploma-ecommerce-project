<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;

class OrderSeeder extends Seeder
{
    public function run()
    {
        Order::factory()
            ->count(10)
            ->has(OrderItem::factory()->count(3), 'items')
            ->create();
    }
}
