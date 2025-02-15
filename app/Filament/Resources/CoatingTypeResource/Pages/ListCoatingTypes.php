<?php

namespace App\Filament\Resources\CoatingTypeResource\Pages;

use App\Filament\Resources\CoatingTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCoatingTypes extends ListRecords
{
    protected static string $resource = CoatingTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
