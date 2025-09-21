<?php

namespace App\Filament\Resources\PensionerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\RelationManagers\RelationManager;

class PensionCasesRelationManager extends RelationManager
{
    protected static string $relationship = 'pensionCases';
    protected static ?string $title = 'Pension Cases';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('pen_ex_no')->label('PEN Ex No'),
            Forms\Components\TextInput::make('status'),
            Forms\Components\DatePicker::make('pen_do_entry')->label('Date of Entry'),
            Forms\Components\TextInput::make('reg_ser_no')->label('Reg/Ser No'),
            Forms\Components\TextInput::make('gp_insurance_claim_ltr')->label('GP Insurance Claim'),
            Forms\Components\TextInput::make('benfund_claim_ltr')->label('BenFund Claim'),
            Forms\Components\TextInput::make('dasb_ltr_no')->label('DASB Ltr No'),
            Forms\Components\DatePicker::make('dasb_ltr_date')->label('DASB Ltr Date'),
            Forms\Components\DatePicker::make('finalized_date'),
            Forms\Components\Textarea::make('remarks')->columnSpanFull(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pen_ex_no')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('pen_do_entry')->date(),
                Tables\Columns\TextColumn::make('reg_ser_no'),
                Tables\Columns\TextColumn::make('finalized_date')->date(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
