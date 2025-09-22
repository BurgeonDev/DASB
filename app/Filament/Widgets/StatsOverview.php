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
        $totalPensioners = Pensioner::count();
        $activeCases = PensionCase::where('status', 'Active')->count();
        $finalizedCases = PensionCase::where('status', 'Finalized')->count();
        $totalFamilyMembers = FamilyMember::count();
        $averagePension = Pensioner::avg('net_pension');

        return [
            Stat::make('Total Pensioners', $totalPensioners)
                ->description('All registered pensioners')
                ->icon('heroicon-o-user-group')
                ->color('success'),

            Stat::make('Family Members', $totalFamilyMembers)
                ->description('Next of Kin (NOK)')
                ->icon('heroicon-o-users')
                ->color('info'),

            Stat::make('Pending Pension Cases', PensionCase::where('status', 'Pending')->count())
                ->description('Awaiting finalization')
                ->icon('heroicon-o-clock')
                ->color('warning'),

            Stat::make('Active Pension Cases', $activeCases)
                ->description('Currently being processed')
                ->icon('heroicon-o-document-text')
                ->color('primary'),

            Stat::make('Finalized Cases', $finalizedCases)
                ->description('Successfully closed')
                ->icon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('Ben Fund Records', BenFund::count())
                ->description('Benevolent fund claims')
                ->icon('heroicon-o-banknotes')
                ->color('primary'),

            Stat::make('Total Pension Amount', '₨ ' . number_format(Pensioner::sum('net_pension')))
                ->description('Cumulative net pension')
                ->icon('heroicon-o-currency-dollar')
                ->color('danger'),

            Stat::make('Average Pension', '₨ ' . number_format($averagePension, 2))
                ->description('Per pensioner average')
                ->icon('heroicon-o-chart-bar')
                ->color('info'),

            Stat::make('Highest Pension', '₨ ' . number_format(Pensioner::max('net_pension')))
                ->description('Top pension amount')
                ->icon('heroicon-o-arrow-trending-up')
                ->color('success'),

            Stat::make('Lowest Pension', '₨ ' . number_format(Pensioner::min('net_pension')))
                ->description('Minimum pension amount')
                ->icon('heroicon-o-arrow-trending-down')
                ->color('danger'),
        ];
    }
}
