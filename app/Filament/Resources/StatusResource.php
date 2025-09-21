<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StatusResource\Pages;
use App\Models\Status;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Maatwebsite\Excel\Excel;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class StatusResource extends Resource
{
    protected static ?string $model = Status::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Lookups';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('status_code')->required(),
            Forms\Components\TextInput::make('progress_code'),
            Forms\Components\TextInput::make('reminder_interval')->numeric(),
            Forms\Components\TextInput::make('reminder_status'),
            Forms\Components\TextInput::make('update_status'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('status_code')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('progress_code')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('reminder_interval')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('reminder_status')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('update_status')->sortable()->searchable(),
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
                        ExcelExport::make()->withWriterType(Excel::XLSX)->label('Excel'), // Excel
                        ExcelExport::make()->withWriterType(Excel::CSV)->label('CSV'),  // CSV
                        ExcelExport::make()->withWriterType(Excel::ODS)->label('ODS'),  // ODS
                        ExcelExport::make()->withWriterType(Excel::HTML)->label('HTML'), // HTML
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
            'index' => Pages\ListStatuses::route('/'),
            'create' => Pages\CreateStatus::route('/create'),
            'edit' => Pages\EditStatus::route('/{record}/edit'),
        ];
    }
}
