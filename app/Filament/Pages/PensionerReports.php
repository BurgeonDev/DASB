<?php

namespace App\Filament\Pages;

use App\Models\Pensioner;
use Filament\Forms;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Table;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;

class PensionerReports extends Page implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text'; // fixed icon
    protected static ?string $navigationGroup = 'Reports';
    protected static string $view = 'filament.pages.pensioner-reports';
    protected static ?string $title = 'Pensioner Reports';

    public function table(Table $table): Table
    {
        return $table
            ->query(Pensioner::query())
            ->columns([
                Tables\Columns\TextColumn::make('personal_no')->label('Personal No')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('rank.rank_full')->label('Rank')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('regtCorps.rw')->label('Regt/Corps')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('type_of_pension')->label('Category')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('district'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('rank_id')
                    ->relationship('rank', 'rank_full')->label('Rank'),

                // Tables\Filters\SelectFilter::make('regt_corps_id')
                //     ->relationship('regtCorps', 'rw')->label('Regt/Corps'),
                Tables\Filters\SelectFilter::make('regt_corps_id')
                    ->options(
                        fn() => \App\Models\RegtCorps::query()
                            ->whereNotNull('rw')
                            ->pluck('rw', 'id')
                            ->toArray()
                    )
                    ->label('Regt/Corps'),

                Tables\Filters\SelectFilter::make('type_of_pension')
                    ->options(
                        fn() => Pensioner::query()
                            ->distinct()
                            ->pluck('type_of_pension', 'type_of_pension')
                            ->mapWithKeys(fn($value) => [
                                $value ?? 'unknown' => $value ?? 'Unknown',
                            ])
                            ->toArray()
                    )
                    ->label('Category'),


            ])
            ->actions([])
            ->bulkActions([
                FilamentExportBulkAction::make('export')
                    ->label('Export Data'),
            ]);
    }
}
