<?php

namespace App\Filament\Resources\PensionerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class FamilyMembersRelationManager extends RelationManager
{
    protected static string $relationship = 'familyMembers';
    protected static ?string $title = 'Family Members';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Name')
                ->required()
                ->maxLength(255),

            Forms\Components\Select::make('relation')
                ->label('Relation')
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
                ->required()
                ->searchable(),

            Forms\Components\DatePicker::make('dob')
                ->label('Date of Birth')
                ->nullable(),

            Forms\Components\DatePicker::make('do_marriage')
                ->label('Date of Marriage')
                ->nullable(),

            Forms\Components\TextInput::make('education')->label('Education')->nullable(),
            Forms\Components\TextInput::make('profession')->label('Profession')->nullable(),

            Forms\Components\Select::make('marital_status')
                ->label('Marital Status')
                ->options([
                    'Single'   => 'Single',
                    'Married'  => 'Married',
                    'Widowed'  => 'Widowed',
                    'Divorced' => 'Divorced',
                ])
                ->nullable(),

            Forms\Components\TextInput::make('cnic_no')->label('CNIC')->nullable(),
            Forms\Components\TextInput::make('mobile_no')->label('Mobile No')->nullable(),

            Forms\Components\TextInput::make('monthly_income')
                ->label('Monthly Income')
                ->numeric()
                ->nullable(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Name')->searchable(),
                Tables\Columns\TextColumn::make('relation')->label('Relation')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('dob')->label('Date of Birth')->date()->sortable(),
                Tables\Columns\TextColumn::make('marital_status')->label('Marital Status')->sortable(),
                Tables\Columns\TextColumn::make('cnic_no')->label('CNIC')->searchable(),
                Tables\Columns\TextColumn::make('mobile_no')->label('Mobile No')->searchable(),
                Tables\Columns\TextColumn::make('monthly_income')->label('Income')->numeric()->sortable(),
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
