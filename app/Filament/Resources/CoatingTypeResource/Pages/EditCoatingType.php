<?php

namespace App\Filament\Resources\CoatingTypeResource\Pages;

use App\Filament\Resources\CoatingTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCoatingType extends EditRecord
{
    protected static string $resource = CoatingTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return 'Редактирование типа покрытия';
    }
}
