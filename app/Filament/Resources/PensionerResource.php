<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PensionerResource\Pages;
use App\Filament\Resources\PensionerResource\RelationManagers;
use App\Models\Pensioner;
use App\Models\Rank;
use App\Models\RegtCorps;
use App\Models\PensionCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PensionerResource extends Resource
{
    protected static ?string $model = Pensioner::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Pension Management';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Basic Information')
                ->columns(3)
                ->schema([
                    Forms\Components\DatePicker::make('date_of_entry')
                        ->label('Date of Entry')
                        ->columnSpan(1),

                    Forms\Components\TextInput::make('prefix')
                        ->maxLength(50)
                        ->columnSpan(1),

                    Forms\Components\TextInput::make('personal_no')
                        ->label('Personal No')
                        ->required()
                        ->maxLength(255)
                        ->columnSpan(1),

                    Forms\Components\Select::make('rank_id')
                        ->label('Rank')
                        ->relationship('rank', 'rank_full')
                        ->searchable()
                        ->preload()
                        ->nullable()
                        ->columnSpan(1),

                    Forms\Components\TextInput::make('trade')
                        ->maxLength(100)
                        ->columnSpan(1),

                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->columnSpan(2),

                    Forms\Components\Select::make('regt_corps_id')
                        ->label('Regt / Corps')
                        ->relationship('regtCorps', 'id')
                        ->getOptionLabelFromRecordUsing(
                            fn($record) => $record->rw
                                ? "{$record->rw} ({$record->force})"
                                : $record->force
                        )
                        ->searchable()
                        ->preload()
                        ->nullable()
                        ->columnSpan(2),

                    Forms\Components\Select::make('type_of_pension')
                        ->label('Type of Pension')
                        ->options(\App\Models\PensionCategory::pluck('pen_cat', 'pen_cat')->toArray())
                        ->searchable()
                        ->preload()
                        ->nullable()
                        ->columnSpan(1),
                ]),

            Forms\Components\Section::make('Family Details')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('nok_name')
                        ->label('Next of Kin Name')
                        ->maxLength(255),

                    Forms\Components\Select::make('nok_relation')
                        ->label('NOK Relation')
                        ->options([
                            'Father' => 'Father',
                            'Mother' => 'Mother',
                            'Wife'   => 'Wife',
                            'Son'    => 'Son',
                            'Daughter' => 'Daughter',
                            'Brother'  => 'Brother',
                            'Sister'   => 'Sister',
                            'Other'    => 'Other',
                        ])
                        ->searchable()
                        ->nullable(),
                ]),

            Forms\Components\Section::make('Address Information')
                ->columns(3)
                ->schema([
                    Forms\Components\TextInput::make('village')->maxLength(255),
                    Forms\Components\TextInput::make('post_office')->maxLength(255),
                    Forms\Components\TextInput::make('uc_name')->label('Union Council')->maxLength(255),
                    Forms\Components\TextInput::make('tehsil')->maxLength(255),
                    Forms\Components\TextInput::make('district')->maxLength(255),
                    Forms\Components\TextInput::make('present_address')
                        ->maxLength(255)
                        ->columnSpan(3),
                ]),

            Forms\Components\Section::make('Contact & Pension')
                ->columns(3)
                ->schema([
                    Forms\Components\TextInput::make('mobile_no')
                        ->label('Mobile No')
                        ->maxLength(20),

                    Forms\Components\TextInput::make('cnic_no')
                        ->label('CNIC')
                        ->maxLength(20),

                    Forms\Components\TextInput::make('net_pension')
                        ->label('Net Pension')
                        ->numeric(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('date_of_entry')->date()->sortable(),
            Tables\Columns\TextColumn::make('personal_no')->label('Personal No')->searchable(),
            Tables\Columns\TextColumn::make('rank.rank_full')->label('Rank')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('name')->searchable(),
            Tables\Columns\TextColumn::make('regtCorps.force')->label('Regt / Corps')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('type_of_pension')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('nok_name')->label('NOK Name')->searchable(),
            Tables\Columns\TextColumn::make('nok_relation')->label('NOK Relation')->sortable(),
            Tables\Columns\TextColumn::make('district')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('mobile_no')->label('Mobile')->searchable(),
            Tables\Columns\TextColumn::make('cnic_no')->label('CNIC')->searchable(),
            Tables\Columns\TextColumn::make('net_pension')->numeric()->sortable(),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')->dateTime()->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('deleted_at')->dateTime()->toggleable(isToggledHiddenByDefault: true),
        ])
            ->filters([
                Tables\Filters\SelectFilter::make('type_of_pension')
                    ->label('Pension Type')
                    ->options(PensionCategory::pluck('pen_cat', 'pen_cat')->toArray())
                    ->searchable(),
                Tables\Filters\SelectFilter::make('district')
                    ->label('District')
                    ->options(Pensioner::query()->distinct()->pluck('district', 'district')->filter()->toArray())
                    ->searchable(),
            ])
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
