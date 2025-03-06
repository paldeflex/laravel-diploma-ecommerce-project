<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static bool $hasTitleCaseModelLabel = false;

    protected static ?string $pluralModelLabel = 'Категории';

    protected static ?string $modelLabel = 'Категория';

    protected static ?int $navigationSort = 3;

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
                                ->placeholder('Введите название продукта')
                                ->maxLength(255)
                                ->live(onBlur: true)
                                ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                                    if (($get('slug') ?? '') !== Str::slug($old)) {
                                        return;
                                    }
                                    $set('slug', Str::slug($state));
                                }),
                            TextInput::make('slug')
                                ->label('Человекопонятный URL')
                                ->readOnly()
                                ->placeholder('Вводить ничего не нужно, сгенерируется сам')
                                ->dehydrated()
                                ->maxLength(255)
                                ->unique(Category::class, 'slug', ignoreRecord: true),
                        ]),
                    FileUpload::make('image')
                        ->label('Изображение')
                        ->image()
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                        ->maxSize(2048)
                        ->validationMessages([
                            'max' => 'Размер файла не должен превышать 2 МБ.',
                        ])
                        ->helperText('Допустимые форматы изображений: JPG, PNG, WebP. Максимальный размер: 2 МБ')
                        ->hidden(fn (string $operation, $record) => $operation === 'view' && $record && ! $record->image)
                        ->directory('categories'),
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
                TextColumn::make('name')
                    ->label('Название')
                    ->placeholder('Не указано')
                    ->sortable()
                    ->searchable(),
                ImageColumn::make('image_url')
                    ->label('Изображение')
                    ->placeholder('Нет изображения'),
                TextColumn::make('slug')
                    ->label('Человекопонятный URL')
                    ->searchable(),
                TextColumn::make('is_active')
                    ->label('Опубликована')
                    ->placeholder('Не указано')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? 'Да' : 'Нет')
                    ->color(fn ($state) => $state ? 'success' : 'danger'),
                TextColumn::make('created_at')
                    ->label('Добавлено')
                    ->placeholder('Не указано')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Изменено')
                    ->placeholder('Не указано')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make(
                    [
                        ViewAction::make(),
                        EditAction::make(),
                        DeleteAction::make()
                            ->action(function ($record) {
                                $count = $record->products()->count();

                                if ($record->products()->count() > 0) {
                                    Notification::make()
                                        ->danger()
                                        ->title('Нельзя удалить категорию')
                                        ->body("Количество продуктов в категории: {$count}. Сначала удалите или перенесите в другую категорию.")
                                        ->send();

                                    return false;
                                }

                                $record->delete();
                            }),
                    ]
                ),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->action(function (Collection $records) {
                            $recordsWithProducts = $records->filter(
                                fn ($record) => $record->products()->count() > 0
                            );

                            if ($recordsWithProducts->isNotEmpty()) {
                                $count = $recordsWithProducts->count();

                                Notification::make()
                                    ->danger()
                                    ->title('Нельзя удалить некоторые категории')
                                    ->body("Количество категорий в которых есть продукты: {$count}. Удаление невозможно.")
                                    ->send();

                                return false;
                            }

                            $records->each->delete();

                            Notification::make()
                                ->success()
                                ->title('Успешно')
                                ->body('Все выбранные категории удалены.')
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }

    public static function setPluralModelLabel(?string $pluralModelLabel): void
    {
        self::$pluralModelLabel = $pluralModelLabel;
    }
}
