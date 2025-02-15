<?php

namespace App\Filament\Resources\CoatingTypeResource\Pages;

use App\Filament\Resources\CoatingTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCoatingType extends CreateRecord
{
    protected static string $resource = CoatingTypeResource::class;

    public function getTitle(): string
    {
        return 'Добавление типа покрытия';
    }
}
