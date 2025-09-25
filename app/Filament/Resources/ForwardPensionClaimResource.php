<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ForwardPensionClaimResource\Pages;
use App\Models\ForwardPensionClaim;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;

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

            Forms\Components\FileUpload::make('documents')
                ->label('Upload Documents')
                ->multiple()
                ->directory('forward-claims')
                ->downloadable()
                ->openable()
                ->previewable()
                ->maxFiles(5),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pension_no')->searchable(),
                Tables\Columns\TextColumn::make('claimant')->searchable(),
                Tables\Columns\TextColumn::make('relation')->sortable(),
                Tables\Columns\TextColumn::make('from_location')->sortable(),
                Tables\Columns\TextColumn::make('to_location')->sortable(),
                Tables\Columns\TextColumn::make('date')->date()->sortable(),

                // Tables\Columns\TextColumn::make('documents')
                //     ->label('Documents')
                //     ->formatStateUsing(function ($state) {
                //         if (empty($state)) {
                //             return '-';
                //         }

                //         // Ensure it's an array
                //         $files = is_array($state) ? $state : json_decode($state, true);

                //         if (!$files) {
                //             return '-';
                //         }

                //         $links = [];
                //         foreach ($files as $file) {
                //             $url = asset('storage/' . $file);
                //             $name = basename($file);
                //             $links[] = "<a href='{$url}' target='_blank' class='text-primary underline'>{$name}</a>";
                //         }

                //         return implode('<br>', $links);
                //     })
                //     ->html(),
                Tables\Columns\ViewColumn::make('documents')
                    ->label('Documents')
                    ->view('tables.columns.forward-claim-documents'),


            ])
            ->filters([
                Tables\Filters\SelectFilter::make('from_location')
                    ->options([
                        'Rwp' => 'Rawalpindi',
                        'Gujrat' => 'Gujrat',
                        'Jhelum' => 'Jhelum',
                    ]),

                Tables\Filters\SelectFilter::make('to_location')
                    ->options([
                        'AC Center' => 'AC Center',
                        'FF Center' => 'FF Center',
                        'BR Center' => 'BR Center',
                        'AK Center' => 'AK Center',
                    ]),

                Tables\Filters\SelectFilter::make('relation')
                    ->options([
                        'Wife' => 'Wife',
                        'Daughter' => 'Daughter',
                        'Son' => 'Son',
                        'Father' => 'Father',
                    ]),

                Tables\Filters\Filter::make('date')
                    ->form([
                        Forms\Components\DatePicker::make('from'),
                        Forms\Components\DatePicker::make('to'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'], fn($q, $date) => $q->whereDate('date', '>=', $date))
                            ->when($data['to'], fn($q, $date) => $q->whereDate('date', '<=', $date));
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),

                // ✅ Export option
                FilamentExportBulkAction::make('export')
                    ->label('Export Data'),
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
