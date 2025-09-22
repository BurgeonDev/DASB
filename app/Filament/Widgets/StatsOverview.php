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
        return [
            Stat::make('Total Pensioners', Pensioner::count())
                ->description('All registered pensioners')
                ->icon('heroicon-o-user-group')
                ->color('success'),

            Stat::make('Family Members', FamilyMember::count())
                ->description('Linked NOK records')
                ->icon('heroicon-o-users')
                ->color('info'),

            Stat::make('Pending Pension Cases', PensionCase::where('status', 'Pending')->count())
                ->description('Awaiting finalization')
                ->icon('heroicon-o-clock')
                ->color('warning'),

            Stat::make('Ben Fund Records', BenFund::count())
                ->description('Benevolent fund cases')
                ->icon('heroicon-o-banknotes')
                ->color('primary'),

            Stat::make('Total Pension Amount', number_format(Pensioner::sum('net_pension')))
                ->description('Net pension sum')
                ->icon('heroicon-o-currency-dollar')
                ->color('danger'),
        ];
    }
}
