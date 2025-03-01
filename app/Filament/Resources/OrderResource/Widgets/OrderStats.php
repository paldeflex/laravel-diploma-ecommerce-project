<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Enums\OrderStatus;
use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Новые', Order::query()->where('status', OrderStatus::NEW->value)->count()),
            Stat::make('В обработке', Order::query()->where('status', OrderStatus::PROCESSING->value)->count()),
            Stat::make('Доставлены', Order::query()->where('status', OrderStatus::SHIPPED->value)->count()),
        ];
    }
}
