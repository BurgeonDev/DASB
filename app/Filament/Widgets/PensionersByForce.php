<?php

namespace App\Filament\Widgets;

use App\Models\Pensioner;
use Filament\Widgets\ChartWidget;

class PensionersByForce extends ChartWidget
{
    protected static ?string $heading = 'Pensioners by Force';

    protected function getData(): array
    {
        $data = Pensioner::join('regt_corps', 'pensioners.regt_corps_id', '=', 'regt_corps.id')
            ->selectRaw('regt_corps.force, COUNT(*) as count')
            ->groupBy('regt_corps.force')
            ->pluck('count', 'regt_corps.force');

        return [
            'datasets' => [
                [
                    'label' => 'Pensioners',
                    'data' => $data->values(),
                    'backgroundColor' => ['#34d399', '#60a5fa', '#f87171'], // army, navy, airforce
                ],
            ],
            'labels' => $data->keys()->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut'; // pie also works
    }
}
