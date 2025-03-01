<?php

use App\Enums\OrderStatus;
use App\Filament\Resources\OrderResource\Widgets\OrderStats;
use App\Models\Order;

use function Pest\Livewire\livewire;

it('correctly counts orders by status', function () {
    Order::factory()->count(3)->create(['status' => OrderStatus::NEW->value]);
    Order::factory()->count(2)->create(['status' => OrderStatus::PROCESSING->value]);
    Order::factory()->count(5)->create(['status' => OrderStatus::SHIPPED->value]);

    livewire(OrderStats::class)
        ->assertSee('Новые')
        ->assertSee('В обработке')
        ->assertSee('Доставлены')
        ->assertSee('3')
        ->assertSee('2')
        ->assertSee('5');
});
