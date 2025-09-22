<?php

namespace App\Filament\Widgets;

use App\Models\Pensioner;
use Filament\Widgets\ChartWidget;

class PensionTrends extends ChartWidget
{
    protected static ?string $heading = 'Pensioner Registrations (Last 6 Months)';

    protected function getData(): array
    {
        $data = Pensioner::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->pluck('count', 'month');

        return [
            'datasets' => [
                [
                    'label' => 'Pensioners',
                    'data' => $data->values(),
                ],
            ],
            'labels' => $data->keys()->map(fn($m) => date('M', mktime(0, 0, 0, $m, 1)))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line'; // can also use 'bar' or 'pie'
    }
}
