<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FamilyMemberResource\Pages;
use App\Models\FamilyMember;
use App\Models\Pensioner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Maatwebsite\Excel\Excel;

class FamilyMemberResource extends Resource
{
    protected static ?string $model = FamilyMember::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Pension Management';

    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Select::make('pensioner_id')
                ->label('Pensioner')
                ->relationship('pensioner', 'name')
                ->searchable()
                ->preload()
                ->required(),

            Forms\Components\TextInput::make('name')->required(),

            Forms\Components\Select::make('relation')
                ->options([
                    'Father'   => 'Father',
                    'Mother'   => 'Mother',
                    'Wife'     => 'Wife',
                    'Son'      => 'Son',
                    'Daughter' => 'Daughter',
                    'Brother'  => 'Brother',
                    'Sister'   => 'Sister',
                    'Other'    => 'Other',
                ])
                ->searchable(),

            Forms\Components\DatePicker::make('dob')->label('Date of Birth'),
            Forms\Components\DatePicker::make('do_death')->label('Date of Death'),
            Forms\Components\DatePicker::make('do_marriage')->label('Date of Marriage'),

            Forms\Components\TextInput::make('education'),
            Forms\Components\TextInput::make('profession'),

            Forms\Components\Select::make('marital_status')
                ->options([
                    'Single' => 'Single',
                    'Married' => 'Married',
                    'Widowed' => 'Widowed',
                    'Divorced' => 'Divorced',
                ]),

            Forms\Components\Select::make('disability')
                ->options(['Yes' => 'Yes', 'No' => 'No'])
                ->nullable(),

            Forms\Components\TextInput::make('cnic_no')->label('CNIC'),
            Forms\Components\TextInput::make('id_marks')->label('ID Marks'),
            Forms\Components\TextInput::make('mobile_no')->label('Mobile No'),

            Forms\Components\TextInput::make('source_of_income')->label('Source of Income'),
            Forms\Components\TextInput::make('monthly_income')->numeric()->label('Monthly Income'),

            Forms\Components\Textarea::make('remarks'),

            Forms\Components\TextInput::make('psb_no')->label('PSB No'),
            Forms\Components\TextInput::make('ppo_no')->label('PPO No'),
            Forms\Components\TextInput::make('gpo')->label('GPO'),
            Forms\Components\TextInput::make('pdo')->label('PDO'),

            Forms\Components\TextInput::make('net_pension')->numeric()->label('Net Pension'),

            Forms\Components\TextInput::make('bank_name')->label('Bank Name'),
            Forms\Components\TextInput::make('bank_branch')->label('Bank Branch'),
            Forms\Components\TextInput::make('bank_code')->label('Bank Code'),
            Forms\Components\TextInput::make('bank_acct_no')->label('Bank Account No'),
            Forms\Components\TextInput::make('iban_no')->label('IBAN No'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pensioner.name')->label('Pensioner')->searchable(),
                Tables\Columns\TextColumn::make('name')->label('Family Member')->searchable(),
                Tables\Columns\TextColumn::make('relation')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('dob')->date()->sortable(),
                Tables\Columns\TextColumn::make('cnic_no')->label('CNIC')->searchable(),
                Tables\Columns\TextColumn::make('mobile_no')->label('Mobile')->searchable(),
                Tables\Columns\TextColumn::make('marital_status')->sortable(),
                Tables\Columns\TextColumn::make('monthly_income')->numeric()->sortable(),
                Tables\Columns\TextColumn::make('bank_name')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('relation')->options([
                    'Father' => 'Father',
                    'Mother' => 'Mother',
                    'Wife' => 'Wife',
                    'Son' => 'Son',
                    'Daughter' => 'Daughter',
                ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
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
            'index' => Pages\ListFamilyMembers::route('/'),
            'create' => Pages\CreateFamilyMember::route('/create'),
            'edit' => Pages\EditFamilyMember::route('/{record}/edit'),
        ];
    }
}
