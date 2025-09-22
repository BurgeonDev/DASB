<?php

namespace App\Filament\Widgets;

use App\Models\Pensioner;
use App\Models\FamilyMember;
use App\Models\BenFund;
use App\Models\PensionCase;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalPensioners    = Pensioner::count();
        $totalFamilyMembers = FamilyMember::count();

        $pendingCases   = PensionCase::where('status', 'Pending')->count();
        $activeCases    = PensionCase::where('status', 'Active')->count();
        $finalizedCases = PensionCase::where('status', 'Finalized')->count();

        $averagePension = Pensioner::avg('net_pension');
        $totalPension   = Pensioner::sum('net_pension');
        $highestPension = Pensioner::max('net_pension');
        $lowestPension  = Pensioner::min('net_pension');

        return [
            // 👤 Pensioner Overview
            Stat::make('Total Pensioners', $totalPensioners)
                ->description('All registered pensioners')
                ->icon('heroicon-o-user-group')
                ->color('success'),

            Stat::make('Family Members', $totalFamilyMembers)
                ->description('Next of Kin (NOK)')
                ->icon('heroicon-o-users')
                ->color('info'),

            Stat::make('Total Pension Amount', '₨ ' . number_format($totalPension))
                ->description('Cumulative net pension')
                ->icon('heroicon-o-currency-dollar')
                ->color('danger'),

            Stat::make('Average Pension', '₨ ' . number_format($averagePension, 2))
                ->description('Per pensioner average')
                ->icon('heroicon-o-chart-bar')
                ->color('primary'),

            Stat::make('Highest Pension', '₨ ' . number_format($highestPension))
                ->description('Top pension amount')
                ->icon('heroicon-o-arrow-trending-up')
                ->color('success'),

            Stat::make('Lowest Pension', '₨ ' . number_format($lowestPension))
                ->description('Minimum pension amount')
                ->icon('heroicon-o-arrow-trending-down')
                ->color('warning'),

            // 📂 Pension Cases
            Stat::make('Pending Cases', $pendingCases)
                ->description('Awaiting finalization')
                ->icon('heroicon-o-clock')
                ->color('warning'),

            Stat::make('Active Cases', $activeCases)
                ->description('Currently in progress')
                ->icon('heroicon-o-document-text')
                ->color('primary'),

            Stat::make('Finalized Cases', $finalizedCases)
                ->description('Successfully closed')
                ->icon('heroicon-o-check-circle')
                ->color('success'),

            // 💰 Benevolent Fund
            Stat::make('Ben Fund Records', BenFund::count())
                ->description('Benevolent fund claims')
                ->icon('heroicon-o-banknotes')
                ->color('primary'),

            // 🪖 Forces & Categories
            Stat::make(
                'Army Pensioners',
                Pensioner::whereHas('regtCorps', fn($q) => $q->where('force', 'Army'))->count()
            )
                ->description('Served in Army')
                ->icon('heroicon-o-shield-check')
                ->color('success'),

            Stat::make(
                'Navy Pensioners',
                Pensioner::whereHas('regtCorps', fn($q) => $q->where('force', 'Navy'))->count()
            )
                ->description('Served in Navy')
                ->icon('heroicon-o-sparkles')
                ->color('info'),

            Stat::make(
                'Airforce Pensioners',
                Pensioner::whereHas('regtCorps', fn($q) => $q->where('force', 'Airforce'))->count()
            )
                ->description('Served in Airforce')
                ->icon('heroicon-o-paper-airplane')
                ->color('danger'),
        ];
    }
}
