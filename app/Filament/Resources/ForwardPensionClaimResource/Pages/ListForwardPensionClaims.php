<?php

namespace App\Filament\Resources\ForwardPensionClaimResource\Pages;

use App\Filament\Resources\ForwardPensionClaimResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListForwardPensionClaims extends ListRecords
{
    protected static string $resource = ForwardPensionClaimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
