<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CoatingTypeResource\Pages;
use App\Models\CoatingType;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class CoatingTypeResource extends Resource
{
    protected static ?string $model = CoatingType::class;

    protected static bool $hasTitleCaseModelLabel = false;

    protected static ?string $navigationIcon = 'heroicon-s-paint-brush';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $pluralModelLabel = 'Типы покрытий';

    protected static ?string $modelLabel = 'Тип покрытия';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    Grid::make()
                        ->schema([
                            TextInput::make('name')
                                ->label('Название')
                                ->required()
                                ->placeholder('Введите название типа покрытия')
                                ->maxLength(255)
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                            TextInput::make('slug')
                                ->label('Человекопонятный URL')
                                ->placeholder('Вводить ничего не нужно, сгенерируется сам')
                                ->readOnly()
                                ->dehydrated()
                                ->maxLength(255)
                                ->unique(CoatingType::class, 'slug', ignoreRecord: true),
                            TextInput::make('description')
                                ->label('Описание')
                                ->placeholder('Введите описание типа покрытия')
                                ->maxLength(255),
                        ]),
                    Toggle::make('is_active')
                        ->label('Опубликовать')
                        ->default(false),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('updated_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->placeholder('Не указано')
                    ->limit(50)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Человекопонятный URL')
                    ->placeholder('Не указано')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Описание')
                    ->placeholder('Не указано')
                    ->limit(50)
                    ->words(5)
                    ->searchable(),
                Tables\Columns\TextColumn::make('is_active')
                    ->label('Опубликована')
                    ->placeholder('Не указано')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? 'Да' : 'Нет')
                    ->color(fn ($state) => $state ? 'success' : 'danger'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Добавлено')
                    ->placeholder('Не указано')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Изменено')
                    ->placeholder('Не указано')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make()
                        ->action(function ($record) {
                            $count = $record->products()->count();

                            if ($count > 0) {
                                Notification::make()
                                    ->danger()
                                    ->title('Нельзя удалить тип покрытия')
                                    ->body("В данном типе покрытия привязан(ы) {$count} товар(ов). Сначала удалите или перенесите их.")
                                    ->send();

                                return false;
                            }

                            $record->delete();
                        }),
                ]),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->action(function (Collection $records) {
                            $recordsWithProducts = $records->filter(fn ($record) => $record->products()->count() > 0);

                            if ($recordsWithProducts->isNotEmpty()) {
                                $count = $recordsWithProducts->count();

                                Notification::make()
                                    ->danger()
                                    ->title('Нельзя удалить некоторые типы покрытий')
                                    ->body("Удаление невозможно. Количество типов с привязанными товарами: {$count}.")
                                    ->send();

                                return false;
                            }

                            $records->each->delete();

                            Notification::make()
                                ->success()
                                ->title('Успешно')
                                ->body('Все выбранные типы покрытий удалены.')
                                ->send();

                            return true;
                        }),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCoatingTypes::route('/'),
            'create' => Pages\CreateCoatingType::route('/create'),
            'edit' => Pages\EditCoatingType::route('/{record}/edit'),
        ];
    }
}
