<?php

namespace App\Filament\Resources\PensionerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\RelationManagers\RelationManager;

class BenFundsRelationManager extends RelationManager
{
    protected static string $relationship = 'benFunds';
    protected static ?string $title = 'Ben Funds';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('ben_pers_no')->label('Ben Pers No'),
            Forms\Components\TextInput::make('bank_name'),
            Forms\Components\TextInput::make('bank_branch'),
            Forms\Components\TextInput::make('account_no'),
            Forms\Components\TextInput::make('iban_no'),
            Forms\Components\TextInput::make('amount_received')->numeric(),
            Forms\Components\DatePicker::make('amount_received_date'),
            Forms\Components\Textarea::make('remarks')->columnSpanFull(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ben_pers_no')->searchable(),
                Tables\Columns\TextColumn::make('bank_name'),
                Tables\Columns\TextColumn::make('bank_branch'),
                Tables\Columns\TextColumn::make('amount_received')->numeric()->sortable(),
                Tables\Columns\TextColumn::make('amount_received_date')->date(),
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
