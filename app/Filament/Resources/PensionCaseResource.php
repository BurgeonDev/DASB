<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PensionCaseResource\Pages;
use App\Models\PensionCase;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Maatwebsite\Excel\Excel;

class PensionCaseResource extends Resource
{
    protected static ?string $model = PensionCase::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Pension Management';


    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\Select::make('pensioner_id')
                ->label('Pensioner')
                ->searchable()
                ->getSearchResultsUsing(
                    fn(string $search) =>
                    \App\Models\Pensioner::query()
                        ->where('name', 'like', "%{$search}%")
                        ->limit(20)
                        ->pluck('name', 'id')
                )
                ->getOptionLabelUsing(
                    fn($value): ?string =>
                    \App\Models\Pensioner::find($value)?->name
                )
                ->required(),



            Forms\Components\TextInput::make('pen_ex_no')->label('PEN Ex No'),
            Forms\Components\Select::make('status')
                ->options([
                    'Initiated' => 'Initiated',
                    'Finalized' => 'Finalized',
                    'Pending'   => 'Pending',
                ])
                ->required(),

            Forms\Components\DatePicker::make('pen_do_entry')->label('Date of Entry')->default(now()),
            Forms\Components\TextInput::make('reg_ser_no')->label('Reg/Ser No'),
            Forms\Components\TextInput::make('gp_insurance_claim_ltr'),
            Forms\Components\TextInput::make('benfund_claim_ltr'),
            Forms\Components\TextInput::make('dasb_ltr_no'),
            Forms\Components\DatePicker::make('dasb_ltr_date'),
            Forms\Components\DatePicker::make('finalized_date'),
            Forms\Components\Textarea::make('remarks')->columnSpanFull(),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pensioner.name')->label('Pensioner')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('pen_ex_no')->sortable()->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'Finalized',
                        'warning' => 'Pending',
                        'primary' => 'Initiated',
                    ]),
                Tables\Columns\TextColumn::make('pen_do_entry')->date(),
                Tables\Columns\TextColumn::make('finalized_date')->date(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                ExportBulkAction::make()
                    ->label('Export')
                    ->exports([
                        ExcelExport::make()
                            ->fromTable()
                            ->withWriterType(Excel::XLSX)
                            ->label('Excel'),
                        ExcelExport::make()
                            ->fromTable()
                            ->withWriterType(Excel::CSV)
                            ->label('CSV'),
                        ExcelExport::make()
                            ->fromTable()
                            ->withWriterType(Excel::ODS)
                            ->label('ODS'),
                        ExcelExport::make()
                            ->fromTable()
                            ->withWriterType(Excel::HTML)
                            ->label('HTML'),
                    ])
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPensionCases::route('/'),
            'create' => Pages\CreatePensionCase::route('/create'),
            'edit' => Pages\EditPensionCase::route('/{record}/edit'),
        ];
    }
}
