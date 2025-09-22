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
            Forms\Components\TextInput::make('bank_name')
                ->label('Bank Name'),

            Forms\Components\TextInput::make('branch_code')
                ->label('Branch Code'),

            Forms\Components\TextInput::make('bank_acct_no')
                ->label('Bank Account No'),

            Forms\Components\TextInput::make('iban_no')
                ->label('IBAN No'),

            Forms\Components\TextInput::make('amount_received')
                ->label('Amount Received')
                ->numeric(),

            Forms\Components\DatePicker::make('amount_received_date')
                ->label('Amount Received Date'),

            Forms\Components\Textarea::make('remarks')
                ->label('Remarks')
                ->columnSpanFull(),

            Forms\Components\Select::make('status')
                ->label('Status')
                ->options([
                    'Received' => 'Received',
                    'Pending' => 'Pending',
                    'Rejected' => 'Rejected',
                ])
                ->default('Received')
                ->searchable(),

            Forms\Components\TextInput::make('originator')
                ->label('Originator'),

            Forms\Components\DatePicker::make('originator_ltr_date')
                ->label('Originator Letter Date'),

            Forms\Components\TextInput::make('originator_ltr_no')
                ->label('Originator Letter No'),

            Forms\Components\Textarea::make('originator_contents')
                ->label('Originator Contents')
                ->columnSpanFull(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bank_name')->label('Bank Name'),
                Tables\Columns\TextColumn::make('branch_code')->label('Branch Code'),
                Tables\Columns\TextColumn::make('amount_received')
                    ->label('Amount Received')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount_received_date')
                    ->label('Received Date')
                    ->date(),
                Tables\Columns\TextColumn::make('status')->label('Status'),
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
