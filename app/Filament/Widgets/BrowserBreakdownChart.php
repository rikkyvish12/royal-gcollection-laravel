<?php

namespace App\Filament\Widgets;

use App\Services\AnalyticsService;
use Filament\Widgets\ChartWidget;

class BrowserBreakdownChart extends ChartWidget
{
    protected static ?string $heading = 'Browser Breakdown (Last 30 Days)';
    protected static ?int $sort = 6;

    protected function getData(): array
    {
        $analytics = app(AnalyticsService::class);
        $browserData = $analytics->getBrowserBreakdown(30);

        $labels = array_keys($browserData);
        $data = array_values($browserData);

        return [
            'datasets' => [
                [
                    'label' => 'Visitors',
                    'data' => $data,
                    'backgroundColor' => [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(239, 68, 68, 0.8)',
                        'rgba(139, 92, 246, 0.8)',
                    ],
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
