<?php

namespace App\Filament\Widgets;

use App\Services\AnalyticsService;
use Filament\Widgets\ChartWidget;

class TrafficSourcesChart extends ChartWidget
{
    protected static ?string $heading = 'Top Traffic Sources (Last 30 Days)';
    protected static ?int $sort = 5;

    protected function getData(): array
    {
        $analytics = app(AnalyticsService::class);
        $sources = $analytics->getTrafficSources(30, 8);

        $labels = [];
        $data = [];

        foreach ($sources as $source) {
            $labels[] = $source['referrer_domain'] ?: 'Direct';
            $data[] = $source['visitors'];
        }

        // Add "Direct" traffic if not present
        $directVisitors = \App\Models\Visitor::whereNull('referrer_domain')
            ->where('first_visit', '>=', now()->subDays(30))
            ->count();
        
        if ($directVisitors > 0) {
            $labels[] = 'Direct';
            $data[] = $directVisitors;
        }

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
                        'rgba(236, 72, 153, 0.8)',
                        'rgba(14, 165, 233, 0.8)',
                        'rgba(107, 114, 128, 0.8)',
                        'rgba(99, 102, 241, 0.8)',
                    ],
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
