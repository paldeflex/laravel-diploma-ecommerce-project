<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'orders';

    protected static ?string $title = 'Заказы';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('id')
                    ->label('Номер заказа')
                    ->searchable(),
                TextColumn::make('grand_total')
                    ->label('Сумма заказа')
                    ->money('RUB'),
                TextColumn::make('status')
                    ->label('Статус товара')
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
            ->filters([
                //
            ])
            ->headerActions([
            ])
            ->actions([

                ActionGroup::make(
                    [
                        Action::make('view_order')
                            ->label('Посмотреть заказ')
                            ->url(fn (Order $record): string => OrderResource::getUrl('view', ['record' => $record->id]))
                            ->color('info')
                            ->icon('heroicon-o-eye'),
                        DeleteAction::make(),
                    ]
                ),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
