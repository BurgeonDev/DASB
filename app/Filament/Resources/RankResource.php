<?php

namespace App\Filament\Resources;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Filament\Resources\RankResource\Pages;
use App\Models\Rank;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Validation\Rule;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Maatwebsite\Excel\Excel;

class RankResource extends Resource
{
    protected static ?string $model = Rank::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Lookups';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('rc')
                ->label('RC')
                ->nullable(),

            Forms\Components\TextInput::make('rank_full')
                ->label('Rank (Full)')
                ->required()
                ->maxLength(255)
                ->rules([
                    fn($record) => Rule::unique('ranks', 'rank_full')->ignore($record),
                ]),

            Forms\Components\Select::make('rank_cat')
                ->label('Category')
                ->options([
                    'Offrs' => 'Officers',
                    'Sldrs' => 'Soldiers',
                    'JCOs'  => 'JCOs',
                ])
                ->nullable()
                ->searchable(),

            Forms\Components\TextInput::make('rank_cat_code')
                ->label('Category Code')
                ->nullable(),

            Forms\Components\TextInput::make('corres_rank')
                ->label('Corresponding Rank')
                ->nullable(),

            Forms\Components\TextInput::make('urdu_rank')
                ->label('Urdu Rank')
                ->nullable(),

            Forms\Components\Select::make('af')
                ->label('Force')
                ->options([
                    'ARMY' => 'Army',
                    'PAF'  => 'Air Force',
                    'Navy' => 'Navy',
                ])
                ->nullable()
                ->searchable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('rank_full')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('rc')->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('rank_cat')->sortable(),
                Tables\Columns\TextColumn::make('rank_cat_code')->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('corres_rank')->sortable(),
                Tables\Columns\TextColumn::make('urdu_rank')->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('af')->sortable()->label('Force'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('rank_cat')
                    ->options([
                        'Offrs' => 'Officers',
                        'Sldrs' => 'Soldiers',
                        'JCOs'  => 'JCOs',
                    ]),
                Tables\Filters\SelectFilter::make('af')
                    ->options([
                        'ARMY' => 'Army',
                        'PAF'  => 'Air Force',
                        'Navy' => 'Navy',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),

                FilamentExportBulkAction::make('export')
                    ->label('Export Data'),

            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRanks::route('/'),
            'create' => Pages\CreateRank::route('/create'),
            'edit' => Pages\EditRank::route('/{record}/edit'),
        ];
    }
}
