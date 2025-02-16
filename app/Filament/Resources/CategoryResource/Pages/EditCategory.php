<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Models\User;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

    public function getTitle(): string
    {
        return 'Редактирование категории';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->action(function ($record) {
                    $count = $record->products()->count();

                    if ($count > 0) {
                        Notification::make()
                            ->danger()
                            ->title('Нельзя удалить категорию')
                            ->body("Количество продуктов в категории: {$count}. Сначала удалите или перенесите в другую категорию.")
                            ->send();
                        return false;
                    }

                    $record->delete();

                    return $this->redirect(CategoryResource::getUrl());
                }),
        ];
    }
}
