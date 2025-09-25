<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ForwardPensionClaimResource\Pages;
use App\Models\ForwardPensionClaim;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use Filament\Forms\Components\FileUpload;

class ForwardPensionClaimResource extends Resource
{
    protected static ?string $model = ForwardPensionClaim::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Pension Management';
    protected static ?string $navigationLabel = 'Forward Pension Claims';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\Select::make('from_location')
                ->label('From')
                ->options([
                    'Rwp' => 'Rawalpindi',
                    'Gujrat' => 'Gujrat',
                    'Jhelum' => 'Jhelum',
                ])
                ->searchable()
                ->required(),

            Forms\Components\Select::make('to_location')
                ->label('To')
                ->options([
                    'AC Center' => 'AC Center',
                    'FF Center' => 'FF Center',
                    'BR Center' => 'BR Center',
                    'AK Center' => 'AK Center',
                ])
                ->multiple() // ✅ multi-select
                ->searchable()
                ->required(),



            Forms\Components\TextInput::make('pension_no')
                ->label('Pension No.')
                ->required(),

            Forms\Components\TextInput::make('claimant')
                ->label('Claimant')
                ->required(),

            Forms\Components\Select::make('relation')
                ->label('Relation with Pensioner')
                ->options([
                    'Father' => 'Father',
                    'Mother' => 'Mother',
                    'Wife'   => 'Wife',
                    'Son'    => 'Son',
                    'Daughter' => 'Daughter',
                    'Brother'  => 'Brother',
                    'Sister'   => 'Sister',
                    'Other'    => 'Other',
                ])
                ->searchable()
                ->required(),

            Forms\Components\DatePicker::make('date')
                ->label('Date')
                ->default(now())
                ->disabled() // uneditable
                ->dehydrated(true), // still saves to DB
            Forms\Components\Textarea::make('message')
                ->label('Message')
                ->rows(3)
                ->nullable(),

            FileUpload::make('documents')
                ->disk('public')
                ->directory('forward-claims')
                ->multiple()
                ->downloadable()
                ->openable()
                ->previewable()
                ->preserveFilenames()
                ->reorderable()
                ->visibility('public')



        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pension_no'),
                Tables\Columns\TextColumn::make('claimant'),
                Tables\Columns\TextColumn::make('relation')->sortable(),
                Tables\Columns\TextColumn::make('from_location')->sortable(),
                Tables\Columns\TextColumn::make('to_location')->sortable(),
                Tables\Columns\TextColumn::make('date')->date()->sortable(),
                Tables\Columns\TextColumn::make('message')
                    ->label('Message')
                    ->formatStateUsing(fn($state) => \Illuminate\Support\Str::limit($state, 30))
                    ->extraAttributes(['class' => 'cursor-pointer text-blue-600 underline'])
                    ->url(fn($record) => null, shouldOpenInNewTab: false) // disable default
                    ->action(
                        Tables\Actions\Action::make('viewMessage')
                            ->label('Read More')
                            ->modalHeading('Message')
                            ->modalContent(fn($record) => view('tables.columns.forward-claim-message', [
                                'message' => $record->message,
                            ]))
                            ->modalSubmitAction(false) // hide submit
                    ),

                Tables\Columns\ViewColumn::make('documents')
                    ->label('Documents')
                    ->view('tables.columns.forward-claim-documents'),
            ])
            ->filters([
                Tables\Filters\Filter::make('search')
                    ->form([
                        Forms\Components\TextInput::make('q')->label('Search')
                            ->placeholder('Search Pension No / Claimant')
                            ->columnSpan(2),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['q'],
                                fn($q, $search) =>
                                $q->where('pension_no', 'like', "%{$search}%")
                                    ->orWhere('claimant', 'like', "%{$search}%")
                                    ->orWhere('relation', 'like', "%{$search}%")
                                    ->orWhere('from_location', 'like', "%{$search}%")
                                    ->orWhere('to_location', 'like', "%{$search}%")
                                    ->orWhere('date', 'like', "%{$search}%")
                            );
                    })
                    ->columnSpan(1),

                Tables\Filters\SelectFilter::make('from_location')
                    ->options([
                        'Rwp' => 'Rawalpindi',
                        'Gujrat' => 'Gujrat',
                        'Jhelum' => 'Jhelum',
                    ])
                    ->label('From')
                    ->native(false)
                    ->columnSpan(1),

                Tables\Filters\SelectFilter::make('to_location')
                    ->options([
                        'AC Center' => 'AC Center',
                        'FF Center' => 'FF Center',
                        'BR Center' => 'BR Center',
                        'AK Center' => 'AK Center',
                    ])
                    ->label('To')
                    ->native(false)
                    ->columnSpan(1),

                Tables\Filters\SelectFilter::make('relation')
                    ->options([
                        'Wife' => 'Wife',
                        'Daughter' => 'Daughter',
                        'Son' => 'Son',
                        'Father' => 'Father',
                    ])
                    ->label('Relation')
                    ->native(false)
                    ->columnSpan(1),

                Tables\Filters\Filter::make('date')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('From')
                            ->native(false)
                            ->columnSpan(1),
                        Forms\Components\DatePicker::make('to')
                            ->label('To')
                            ->native(false)
                            ->columnSpan(1),
                    ])
                    ->columns(2) // ✅ put from/to in the same row
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'], fn($q, $date) => $q->whereDate('date', '>=', $date))
                            ->when($data['to'], fn($q, $date) => $q->whereDate('date', '<=', $date));
                    })
                    ->label('Date Range')
                    ->columnSpan(2),
            ], layout: Tables\Enums\FiltersLayout::AboveContent)
            ->filtersFormColumns(6) // ✅ all filters in one row (adjust number if needed)

            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                FilamentExportBulkAction::make('export')->label('Export Data'),
            ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListForwardPensionClaims::route('/'),
            'create' => Pages\CreateForwardPensionClaim::route('/create'),
            'edit' => Pages\EditForwardPensionClaim::route('/{record}/edit'),
        ];
    }
}
