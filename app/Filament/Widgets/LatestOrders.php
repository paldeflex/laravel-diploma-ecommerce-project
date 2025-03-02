<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrders extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(OrderResource::getEloquentQuery())
            ->heading('Последние заказы')
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'DESC')
            ->columns([
                TextColumn::make('id')
                    ->label('Номер заказа')
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('Имя покупателя')
                    ->searchable(),
                TextColumn::make('grand_total')
                    ->label('Сумма заказа')
                    ->money('RUB'),
                TextColumn::make('status')
                    ->label('Статус заказа')
                    ->badge()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('payment_method')
                    ->label('Тип оплаты')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('payment_status')
                    ->label('Статус оплаты')
                    ->sortable()
                    ->badge()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Дата заказа')
                    ->dateTime(),
            ])
            ->actions([
                Action::make('view_order')
                    ->label('Посмотреть заказ')
                    ->url(fn (Order $record): string => OrderResource::getUrl('view', ['record' => $record->id]))
                    ->color('info')
                    ->icon('heroicon-o-eye'),
            ]);
    }
}
