<?php

use App\Enums\OrderStatus;
use App\Filament\Resources\OrderResource\Pages\ListOrders;
use App\Models\Order;

it('filters orders by status', function () {
    Order::factory()->count(2)->create(['status' => OrderStatus::NEW->value]);
    Order::factory()->count(3)->create(['status' => OrderStatus::PROCESSING->value]);

    $page = new ListOrders;
    $filteredQuery = $page->getTabs()[OrderStatus::NEW->value]->modifyQuery(Order::query());

    expect($filteredQuery->count())->toBe(2);
});
