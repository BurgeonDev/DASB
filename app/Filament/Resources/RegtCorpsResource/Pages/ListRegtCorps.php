<?php

namespace App\Filament\Resources\RegtCorpsResource\Pages;

use App\Filament\Resources\RegtCorpsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRegtCorps extends ListRecords
{
    protected static string $resource = RegtCorpsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
