<?php

namespace App\Filament\Resources\PensionCaseResource\Pages;

use App\Filament\Resources\PensionCaseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPensionCase extends EditRecord
{
    protected static string $resource = PensionCaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
