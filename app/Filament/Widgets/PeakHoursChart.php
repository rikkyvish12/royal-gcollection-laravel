<?php

namespace App\Filament\Widgets;

use App\Services\AnalyticsService;
use Filament\Widgets\ChartWidget;

class PeakHoursChart extends ChartWidget
{
    protected static ?string $heading = 'Peak Traffic Hours (Last 30 Days)';
    protected static ?int $sort = 7;

    protected function getData(): array
    {
        $analytics = app(AnalyticsService::class);
        $peakHoursData = $analytics->getPeakHours(30);

        // Highlight peak hours with different color
        $maxViews = max($peakHoursData['data']);
        $backgroundColors = array_map(function ($views) use ($maxViews) {
            $intensity = $views / $maxViews;
            return "rgba(251, 191, 36, {$intensity})";
        }, $peakHoursData['data']);

        return [
            'datasets' => [
                [
                    'label' => 'Page Views',
                    'data' => $peakHoursData['data'],
                    'backgroundColor' => $backgroundColors,
                    'borderColor' => 'rgb(251, 191, 36)',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $peakHoursData['labels'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
