<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    public function getCreateAnotherFormAction(): Action
    {
        return parent::getCreateAnotherFormAction()->label('Создать и добавить ещё');
    }
}
