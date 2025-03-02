<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AddressRelationManager extends RelationManager
{
    protected static string $relationship = 'address';

    protected static ?string $title = 'Адрес доставки';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('first_name')
                            ->label('Имя получателя')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('last_name')
                            ->label('Фамилия получателя')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->label('Номер телефона')
                            ->required()
                            ->tel()
                            ->maxLength(255),
                        TextInput::make('city')
                            ->label('Город проживания')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('region')
                            ->label('Область')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('zip_code')
                            ->label('Почтовый индекс')
                            ->required()
                            ->numeric()
                            ->maxLength(6),
                        Textarea::make('street_address')
                            ->label('Улица, дом, квартира')
                            ->required()
                            ->maxLength(255),
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('street_address')
            ->columns([
                TextColumn::make('full_name')->label('Полное имя'),
                TextColumn::make('phone')->label('Телефон'),
                TextColumn::make('city')->label('Город'),
                TextColumn::make('region')->label('Область'),
                TextColumn::make('zip_code')->label('Почтовый индекс'),
                TextColumn::make('street_address')->label('Адрес'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->createAnother(false)
                    ->visible(fn () => $this->ownerRecord->address === null),
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
}
