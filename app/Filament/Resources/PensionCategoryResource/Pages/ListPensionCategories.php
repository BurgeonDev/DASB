<?php

namespace App\Filament\Resources\PensionCategoryResource\Pages;

use App\Filament\Resources\PensionCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPensionCategories extends ListRecords
{
    protected static string $resource = PensionCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
