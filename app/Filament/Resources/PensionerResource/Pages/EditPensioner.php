<?php

namespace App\Filament\Resources\PensionerResource\Pages;

use App\Filament\Resources\PensionerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPensioner extends EditRecord
{
    protected static string $resource = PensionerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
