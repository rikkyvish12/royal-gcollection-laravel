<?php

namespace App\Filament\Widgets;

use App\Services\AnalyticsService;
use Filament\Widgets\ChartWidget;

class DeviceBreakdownChart extends ChartWidget
{
    protected static ?string $heading = 'Device Breakdown (Last 30 Days)';
    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $analytics = app(AnalyticsService::class);
        $deviceData = $analytics->getDeviceBreakdown(30);

        $labels = [];
        $data = [];
        $colors = [
            'desktop' => 'rgb(59, 130, 246)',
            'mobile' => 'rgb(16, 185, 129)',
            'tablet' => 'rgb(245, 158, 11)',
            'unknown' => 'rgb(107, 114, 128)',
        ];

        foreach ($deviceData as $device => $count) {
            $labels[] = ucfirst($device);
            $data[] = $count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Visitors',
                    'data' => $data,
                    'backgroundColor' => array_map(fn($device) => $colors[strtolower($device)] ?? 'rgb(107, 114, 128)', $labels),
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
