<?php

namespace App\Filament\Resources;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\ShippingMethod;
use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Number;
use Filament\Forms\Components\Hidden;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static bool $hasTitleCaseModelLabel = false;

    protected static ?string $pluralModelLabel = 'Заказы';

    protected static ?string $modelLabel = 'Заказ';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make([
                    Section::make('Информация о заказе')->schema([
                        Group::make([
                            Select::make('user_id')
                                ->label('Покупатель')
                                ->relationship('user', 'name')
                                ->searchable()
                                ->preload()
                                ->required()
                                ->columnSpan(3),
                            Select::make('payment_method')
                                ->label('Тип оплаты')
                                ->options(PaymentMethod::class)
                                ->required()
                                ->columnSpan(3),
                            Select::make('shipping_method')
                                ->label('Способ доставки')
                                ->options(ShippingMethod::class)
                                ->default('pending')
                                ->required()
                                ->columnSpan(3),
                            Select::make('payment_status')
                                ->label('Статус оплаты')
                                ->options(PaymentMethod::class)
                                ->default('pending')
                                ->required()
                                ->columnSpan(3),
                        ])->columns(6),
                        ToggleButtons::make('status')
                            ->label('Статус товара')
                            ->inline()
                            ->default(OrderStatus::NEW->value)
                            ->required()
                            ->options(OrderStatus::class)
                            ->columnSpanFull(),
                    ]),
                    Section::make('Заказанные товары')->schema([
                        Repeater::make('items')
                            ->label('товарам')
                            ->hiddenLabel()
                            ->relationship()
                            ->schema([
                                Select::make('product_id')
                                    ->label('Продукция')
                                    ->relationship('product', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->distinct()
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                    ->live()
                                    ->afterStateUpdated(function ($state, Set $set) {
                                        $set('quantity', 1);
                                        $set('unit_amount', null);
                                        $set('total_amount', null);

                                        if ($state) {
                                            $product = Product::find($state);
                                            $price = $product->price ?? 0;

                                            $set('unit_amount', $price);
                                            $set('total_amount', $price);
                                        }
                                    })
                                    ->columnSpan(4),
                                TextInput::make('quantity')
                                    ->label('Количество')
                                    ->numeric()
                                    ->required()
                                    ->default(1)
                                    ->minValue(1)
                                    ->live(onBlur: true)
                                    ->disabled(fn(Get $get) => empty($get('product_id')))
                                    ->afterStateUpdated(fn($state, Set $set, Get $get) => $set('total_amount', \round($state * $get('unit_amount'), 2)))
                                    ->columnSpan(2),
                                TextInput::make('unit_amount')
                                    ->label('Цена за единицу')
                                    ->numeric()
                                    ->readOnly()
                                    ->dehydrated()
                                    ->columnSpan(3),
                                TextInput::make('total_amount')
                                    ->label('Общая стоимость')
                                    ->numeric()
                                    ->dehydrated()
                                    ->readOnly()
                                    ->columnSpan(3),
                            ])->columns(12),
                        Placeholder::make('grand_total_placeholder')
                            ->label('Сумма заказа')
                            ->default(0)
                            ->content(function (Get $get, Set $set) {
                                $total = 0;
                                if (!$repeaters = $get('items')) {
                                    return $total;
                                }

                                foreach ($repeaters as $key => $repeater) {
                                    $total += $get("items.{$key}.total_amount");
                                }
                                $set('grand_total', $total);
                                return Number::currency($total, 'RUB', 'ru_RU');
                            }),

                        Hidden::make('grand_total')
                            ->default(0)

                    ])
                ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Покупатель')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('grand_total')
                    ->label('Сумма заказа')
                    ->numeric()
                    ->sortable()
                    ->searchable()
                    ->money('RUB'),
                TextColumn::make('payment_method')
                    ->label('Тип оплаты')
                    ->searchable()
                ->sortable(),
                TextColumn::make('payment_status')
                    ->label('Статус оплаты')
                    ->sortable(),
                SelectColumn::make('status')
                    ->label('Статус товара')
                    ->options(OrderStatus::class)
                ->searchable()
                ->sortable(),
                TextColumn::make('shipping_method')
                    ->label('Способ доставки')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Добавлено')
                    ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Изменено')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make(
                    [
                        ViewAction::make(),
                        EditAction::make(),
                        DeleteAction::make(),
                    ]
                ),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 10 ? 'danger' : 'success';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
