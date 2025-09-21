<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PensionerResource\Pages;
use App\Filament\Resources\PensionerResource\RelationManagers;
use App\Models\Pensioner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PensionerResource extends Resource
{
    protected static ?string $model = Pensioner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\DatePicker::make('date_of_entry'),
            Forms\Components\TextInput::make('prefix')
                ->maxLength(255),
            Forms\Components\TextInput::make('personal_no')
                ->required()
                ->maxLength(255),
            Forms\Components\Select::make('rank_id')
                ->relationship('rank', 'rank_full')
                ->searchable()
                ->preload()
                ->nullable(),
            Forms\Components\TextInput::make('trade')
                ->maxLength(255),
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
            Forms\Components\Select::make('regt_corps_id')
                ->relationship('regtCorps', 'force')
                ->searchable()
                ->preload()
                ->nullable(),
            Forms\Components\TextInput::make('type_of_pension')
                ->maxLength(255),
            Forms\Components\TextInput::make('parent_unit')
                ->maxLength(255),
            Forms\Components\TextInput::make('nok_name')
                ->maxLength(255),
            Forms\Components\TextInput::make('nok_relation')
                ->maxLength(255),
            Forms\Components\TextInput::make('village')
                ->maxLength(255),
            Forms\Components\TextInput::make('post_office')
                ->maxLength(255),
            Forms\Components\TextInput::make('uc_name')
                ->maxLength(255),
            Forms\Components\TextInput::make('tehsil')
                ->maxLength(255),
            Forms\Components\TextInput::make('district')
                ->maxLength(255),
            Forms\Components\TextInput::make('present_address')
                ->maxLength(255),
            Forms\Components\TextInput::make('mobile_no')
                ->maxLength(255),
            Forms\Components\TextInput::make('cnic_no')
                ->maxLength(255),
            Forms\Components\TextInput::make('net_pension')
                ->numeric(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('date_of_entry')->date()->sortable(),
            Tables\Columns\TextColumn::make('prefix')->searchable(),
            Tables\Columns\TextColumn::make('personal_no')->searchable(),
            Tables\Columns\TextColumn::make('rank.rank_full')->label('Rank')->searchable(),
            Tables\Columns\TextColumn::make('trade')->searchable(),
            Tables\Columns\TextColumn::make('name')->searchable(),
            Tables\Columns\TextColumn::make('regtCorps.force')->label('Regt/Corps')->searchable(),
            Tables\Columns\TextColumn::make('type_of_pension')->searchable(),
            Tables\Columns\TextColumn::make('parent_unit')->searchable(),
            Tables\Columns\TextColumn::make('nok_name')->searchable(),
            Tables\Columns\TextColumn::make('nok_relation')->searchable(),
            Tables\Columns\TextColumn::make('village')->searchable(),
            Tables\Columns\TextColumn::make('post_office')->searchable(),
            Tables\Columns\TextColumn::make('uc_name')->searchable(),
            Tables\Columns\TextColumn::make('tehsil')->searchable(),
            Tables\Columns\TextColumn::make('district')->searchable(),
            Tables\Columns\TextColumn::make('present_address')->searchable(),
            Tables\Columns\TextColumn::make('mobile_no')->searchable(),
            Tables\Columns\TextColumn::make('cnic_no')->searchable(),
            Tables\Columns\TextColumn::make('net_pension')->numeric()->sortable(),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('deleted_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
        ])
            ->filters([])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\FamilyMembersRelationManager::class,
            RelationManagers\PensionCasesRelationManager::class,
            RelationManagers\BenFundsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPensioners::route('/'),
            'create' => Pages\CreatePensioner::route('/create'),
            'edit' => Pages\EditPensioner::route('/{record}/edit'),
        ];
    }
}
