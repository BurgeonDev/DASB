<?php

namespace App\Filament\Resources\RegtCorpsResource\Pages;

use App\Filament\Resources\RegtCorpsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRegtCorps extends EditRecord
{
    protected static string $resource = RegtCorpsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
