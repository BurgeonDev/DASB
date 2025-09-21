<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PensionCategoryResource\Pages;
use App\Models\PensionCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Validation\Rule;

class PensionCategoryResource extends Resource
{
    protected static ?string $model = PensionCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Lookups';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('pen_cat')
                ->label('Category')
                ->required()
                ->maxLength(255)
                ->rules([
                    function ($record) {
                        $id = $record instanceof PensionCategory ? $record->id : $record;
                        return Rule::unique('pension_categories', 'pen_cat')->ignore($id);
                    },
                ]),

            Forms\Components\TextInput::make('pen_cat_code')
                ->label('Code')
                ->maxLength(50), // ✅ removed uniqueness

            Forms\Components\Select::make('pen_type')
                ->label('Type')
                ->options([
                    'Family Pensioner' => 'Family Pensioner',
                    'Retired' => 'Retired',
                    'Shaheed' => 'Shaheed',
                    'Disabled' => 'Disabled',
                    'Non Pensioner' => 'Non Pensioner',
                ])
                ->nullable()
                ->searchable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pen_cat')
                    ->label('Category')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('pen_cat_code')
                    ->label('Code')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('pen_type')
                    ->label('Type')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('pen_type')
                    ->options([
                        'Family Pensioner' => 'Family Pensioner',
                        'Retired' => 'Retired',
                        'Shaheed' => 'Shaheed',
                        'Disabled' => 'Disabled',
                        'Non Pensioner' => 'Non Pensioner',
                    ])
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->requiresConfirmation(),
                ]),
            ])
            ->defaultSort('pen_cat', 'asc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPensionCategories::route('/'),
            'create' => Pages\CreatePensionCategory::route('/create'),
            'edit' => Pages\EditPensionCategory::route('/{record}/edit'),
        ];
    }
}
