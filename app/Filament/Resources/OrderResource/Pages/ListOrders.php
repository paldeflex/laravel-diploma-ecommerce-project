<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Enums\OrderStatus;
use App\Filament\Resources\OrderResource;
use App\Filament\Resources\OrderResource\Widgets\OrderStats;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Facades\FilamentView;
use Filament\Tables\View\TablesRenderHook;
use Illuminate\Support\Facades\Blade;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            OrderStats::class,
        ];
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('Все'),
            OrderStatus::NEW->value => Tab::make('Новые')->query(fn ($query) => $query->where('status', OrderStatus::NEW->value)),
            OrderStatus::PROCESSING->value => Tab::make('В обработке')->query(fn ($query) => $query->where('status', OrderStatus::PROCESSING->value)),
            OrderStatus::SHIPPED->value => Tab::make('Отправлено')->query(fn ($query) => $query->where('status', OrderStatus::SHIPPED->value)),
            OrderStatus::DELIVERED->value => Tab::make('Доставлено')->query(fn ($query) => $query->where('status', OrderStatus::DELIVERED->value)),
            OrderStatus::CANCELED->value => Tab::make('Отменено')->query(fn ($query) => $query->where('status', OrderStatus::CANCELED->value)),
        ];
    }

    public function getView(): string
    {
        FilamentView::registerRenderHook(
            TablesRenderHook::TOOLBAR_START,
            fn (): string => Blade::render('<x-filament::loading-indicator wire:loading class="h-5 w-5" />')
        );

        return parent::getView();
    }
}
