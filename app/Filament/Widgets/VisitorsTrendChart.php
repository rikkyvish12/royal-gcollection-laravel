<?php

namespace App\Filament\Widgets;

use App\Services\AnalyticsService;
use Filament\Widgets\ChartWidget;

class VisitorsTrendChart extends ChartWidget
{
    protected static ?string $heading = 'Visitors & Page Views Trend (Last 30 Days)';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $analytics = app(AnalyticsService::class);
        $trendData = $analytics->getVisitorsTrend(30);

        return [
            'datasets' => [
                [
                    'label' => 'Visitors',
                    'data' => $trendData['visitors'],
                    'backgroundColor' => 'rgba(59, 130, 246, 0.2)',
                    'borderColor' => 'rgb(59, 130, 246)',
                    'borderWidth' => 2,
                    'tension' => 0.4,
                ],
                [
                    'label' => 'Page Views',
                    'data' => $trendData['page_views'],
                    'backgroundColor' => 'rgba(16, 185, 129, 0.2)',
                    'borderColor' => 'rgb(16, 185, 129)',
                    'borderWidth' => 2,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $trendData['labels'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
