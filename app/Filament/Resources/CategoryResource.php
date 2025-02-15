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
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static bool $hasTitleCaseModelLabel = false;

    protected static ?string $pluralModelLabel = 'Категории';

    protected static ?string $modelLabel = 'Категория';

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
                                ->maxLength(255)
                                ->debounce(1000)
                                ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                            TextInput::make('slug')
                                ->label('Человекопонятный URL')
                                ->readOnly()
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
                        ->hidden(fn ($record) => $record && ! $record->image)
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
            ->columns([
                TextColumn::make('name')
                    ->label('Название')
                    ->searchable(),
                ImageColumn::make('image_url')
                    ->label('Изображение'),
                TextColumn::make('slug')
                    ->label('Человекопонятный URL')
                    ->searchable(),
                TextColumn::make('is_active')
                    ->label('Опубликована')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? 'Да' : 'Нет')
                    ->color(fn ($state) => $state ? 'success' : 'danger'),
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
                Tables\Actions\ActionGroup::make(
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
