<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers\OrdersRelationManager;
use App\Models\User;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static bool $hasTitleCaseModelLabel = false;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $pluralModelLabel = 'Пользователи';

    protected static ?string $modelLabel = 'Пользователь';

    protected static ?int $navigationSort = 1;

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->label('Имя')
                            ->placeholder('Введите имя пользователя')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('Электронная почта')
                            ->placeholder('Введите email')
                            ->email()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->required(),
                        DateTimePicker::make('email_verified_at')
                            ->label('Дата подтверждения электронной почты')
                            ->default(now()),
                        TextInput::make('password')
                            ->label('Пароль')
                            ->placeholder('Введите пароль')
                            ->password()
                            ->minLength(6)
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (Page $livewire): bool => $livewire instanceof CreateRecord),
                    ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('updated_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Имя')
                    ->searchable()
                    ->sortable()
                    ->limit(50)

                    ->placeholder('Не указано'),
                Tables\Columns\TextColumn::make('email')
                    ->label('Электронная почта')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->placeholder('Не указано'),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->label('Дата подтверждения эл. почты')
                    ->dateTime()
                    ->placeholder('Не подтверждён')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime()
                    ->sortable()
                    ->placeholder('Не указано'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Дата обновления')
                    ->dateTime()
                    ->sortable()
                    ->placeholder('Не указано'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
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
            OrdersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
