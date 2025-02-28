<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Order;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    public function run(): void
    {
        $addressFactory = Address::factory();

        foreach (Order::all() as $order) {
            $addressFactory->create([
                'order_id' => $order->id,
                'user_id' => $order->user_id,
            ]);
        }
    }
}
