<?php

namespace App\Filament\Resources\PensionerResource\Pages;

use App\Filament\Resources\PensionerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPensioners extends ListRecords
{
    protected static string $resource = PensionerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
