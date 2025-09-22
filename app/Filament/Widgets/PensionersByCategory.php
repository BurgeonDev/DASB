<?php

namespace App\Filament\Widgets;

use App\Models\Pensioner;
use Filament\Widgets\ChartWidget;

class PensionersByCategory extends ChartWidget
{
    protected static ?string $heading = 'Pensioners by Category';

    protected function getData(): array
    {
        $data = Pensioner::selectRaw('type_of_pension, COUNT(*) as count')
            ->groupBy('type_of_pension')
            ->pluck('count', 'type_of_pension');

        return [
            'datasets' => [
                [
                    'label' => 'Categories',
                    'data' => $data->values(),
                    'backgroundColor' => ['#fbbf24', '#3b82f6', '#10b981', '#ef4444'],
                ],
            ],
            'labels' => $data->keys()->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'pie'; // radial chart
    }
}
