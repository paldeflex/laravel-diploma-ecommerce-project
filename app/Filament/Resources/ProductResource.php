<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\CoatingType;
use App\Models\Product;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static bool $hasTitleCaseModelLabel = false;

    protected static ?string $pluralModelLabel = 'Продукция';

    protected static ?string $modelLabel = 'Продукция';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Основная информация')->schema([
                        TextInput::make('name')
                            ->label('Название')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                        TextInput::make('slug')
                            ->label('Человекопонятный URL')
                            ->maxLength(255)
                            ->readOnly()
                            ->unique(Product::class, 'slug', ignoreRecord: true),
                        TextInput::make('price')
                            ->label('Стоимость')
                            ->numeric()
                            ->required()
                            ->prefix('₽')->columnSpanFull(),
                        MarkdownEditor::make('description')
                            ->label('Описание')
                            ->columnSpanFull()
                            ->fileAttachmentsDirectory('products'),
                    ])->columns(),

                    Section::make('Изображения продукции')->schema([
                        FileUpload::make('images')
                            ->label(fn ($record) => $record && is_array($record->images) && count($record->images) > 0
                                ? 'Изображений загружено: '.count($record->images)
                                : 'Изображений для данной продукции нет'
                            )
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->maxSize(2048)
                            ->multiple()
                            ->directory('products')
                            ->maxFiles(5)
                            ->validationMessages([
                                'max' => 'Размер файла не должен превышать 2 МБ.',
                            ])
                            ->reorderable()
                            ->helperText('Допустимые форматы изображений: JPG, PNG, WebP. Максимальный размер: 2 МБ. Не более 5 изображений'),
                    ]),
                ])->columnSpan(2),
                Group::make()->schema([

                    Section::make('Принадлежность')->schema([
                        Select::make('category_id')
                            ->label('Категория')
                            ->required()
                            ->searchable()
                            ->placeholder('Выберите категорию')
                            ->preload()
                            ->relationship('category', 'name'),
                        Select::make('coatingTypes')
                            ->label('Тип покрытия')
                            ->multiple()
                            ->required()
                            ->searchable()
                            ->placeholder('Выберите тип покрытия')
                            ->preload()
                            ->relationship('coatingTypes', 'name'),
                    ]),
                    Section::make('Статусы продукции')->schema([
                        Toggle::make('in_stock')
                            ->label('В наличии')
                            ->required()
                            ->default(true),
                        Toggle::make('is_featured')
                            ->label('Рекомендуемый')
                            ->required()
                            ->default(true),
                        Toggle::make('is_active')
                            ->label('Опубликована')
                            ->required(),
                        Toggle::make('on_sale')
                            ->label('На распродаже')
                            ->required(),
                    ]),
                ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Название')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug')
                    ->label('Человекопонятный URL')
                    ->searchable(),
                TextColumn::make('category.name')
                    ->label('Категория')
                    ->sortable(),
                TextColumn::make('coatingTypes.name')
                    ->label('Тип покрытия')
                    ->badge(),
                TextColumn::make('price')
                    ->label('Цена')
                    ->money('RUB')
                    ->sortable(),
                TextColumn::make('is_featured')
                    ->label('Рекомендуемый')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? 'Да' : 'Нет')
                    ->color(fn ($state) => $state ? 'success' : 'danger'),
                TextColumn::make('in_stock')
                    ->label('В наличии')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? 'Да' : 'Нет')
                    ->color(fn ($state) => $state ? 'success' : 'danger'),
                TextColumn::make('on_sale')
                    ->label('На распродаже')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? 'Да' : 'Нет')
                    ->color(fn ($state) => $state ? 'success' : 'danger'),
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
                SelectFilter::make('category')
                    ->relationship('category', 'name')
                    ->label('Категория'),
                SelectFilter::make('coatingTypes')
                    ->label('Тип покрытия')
                    ->multiple()
                    ->options(fn () => CoatingType::pluck('name', 'id')->toArray())
                    ->preload()
                    ->searchable()
                    ->modifyQueryUsing(function (Builder $query, array $state) {
                        if (! empty($state['values'])) {
                            return $query->whereHas('coatingTypes', fn ($q) => $q->whereIn('coating_types.id', $state['values'])
                            );
                        }

                        return $query;
                    }),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
