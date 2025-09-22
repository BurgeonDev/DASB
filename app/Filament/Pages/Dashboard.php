<?php

namespace App\Filament\Pages;

use App\Models\Pensioner;
use App\Models\FamilyMember;
use App\Models\BenFund;
use App\Models\PensionCase;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $title = 'Admin Dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            Widgets\StatsOverviewWidget::class,
        ];
    }
}
