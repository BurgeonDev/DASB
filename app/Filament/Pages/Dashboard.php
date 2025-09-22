<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\PensionTrends;
use App\Filament\Widgets\StatsOverview;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $title = 'Admin Dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverview::class,
            PensionTrends::class,
        ];
    }
}
