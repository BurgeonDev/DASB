<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegtCorpsResource\Pages;
use App\Models\RegtCorps;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Validation\Rule;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Maatwebsite\Excel\Excel;

class RegtCorpsResource extends Resource
{
    protected static ?string $model = RegtCorps::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Lookups';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('force_code')->label('Force Code')->nullable(),

            Forms\Components\Select::make('force')
                ->label('Force')
                ->options([
                    'Army' => 'Army',
                    'PAF'  => 'Air Force',
                    'Navy' => 'Navy',
                    'Other' => 'Other',
                ])
                ->required()
                ->searchable(),

            Forms\Components\TextInput::make('regt_code')
                ->label('Regt Code')
                ->nullable()
                ->rules([
                    fn($record) => Rule::unique('regt_corps', 'regt_code')
                        ->where(fn($q) => $q->where('force', request()->input('force')))
                        ->ignore($record),
                ]),

            Forms\Components\TextInput::make('rw')->label('RW')->nullable(),
            Forms\Components\TextInput::make('rw_loc')->label('RW Location')->nullable(),
            Forms\Components\TextInput::make('rw_tel_no')->label('RW Tel No')->nullable(),

            Forms\Components\TextInput::make('urdu_rw')->label('Urdu RW')->nullable(),
            Forms\Components\TextInput::make('urdu_rw_loc')->label('Urdu RW Loc')->nullable(),
            Forms\Components\TextInput::make('urdu_regt')->label('Urdu Regt')->nullable(),

            Forms\Components\Textarea::make('text_sro')->label('SRO')->nullable(),
            Forms\Components\Textarea::make('urdu_text_sro')->label('Urdu SRO')->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('force')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('regt_code')->sortable()->searchable()->toggleable(),
            Tables\Columns\TextColumn::make('rw')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('rw_loc')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('urdu_regt')->sortable()->searchable()->toggleable(),
        ])
            ->filters([
                Tables\Filters\SelectFilter::make('force')
                    ->options([
                        'Army' => 'Army',
                        'PAF'  => 'Air Force',
                        'Navy' => 'Navy',
                        'Other' => 'Other',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                ExportBulkAction::make()
                    ->label('Export')
                    ->exports([
                        ExcelExport::make()->withWriterType(Excel::XLSX)->label('Excel'),
                        ExcelExport::make()->withWriterType(Excel::CSV)->label('CSV'),
                        ExcelExport::make()->withWriterType(Excel::ODS)->label('ODS'),
                        ExcelExport::make()->withWriterType(Excel::HTML)->label('HTML'),
                    ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRegtCorps::route('/'),
            'create' => Pages\CreateRegtCorps::route('/create'),
            'edit' => Pages\EditRegtCorps::route('/{record}/edit'),
        ];
    }
}
