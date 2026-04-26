<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;

class OrderTrendsChart extends ChartWidget
{
    protected static ?string $heading = 'Order Trends (Last 30 Days)';
    protected static ?int $sort = 2;
    
    protected function getData(): array
    {
        $data = Order::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        
        $dates = [];
        $counts = [];
        
        // Initialize all dates in the range
        $period = new \DatePeriod(
            now()->subDays(30)->startOfDay(),
            new \DateInterval('P1D'),
            now()->endOfDay()
        );
        
        foreach ($period as $date) {
            $dateKey = $date->format('Y-m-d');
            $dates[] = $date->format('M d');
            $counts[$dateKey] = 0;
        }
        
        // Fill in actual data
        foreach ($data as $record) {
            $dateKey = $record->date; // $record->date is already a string from selectRaw
            if (isset($counts[$dateKey])) {
                $counts[$dateKey] = $record->count;
            }
        }
        
        return [
            'datasets' => [
                [
                    'label' => 'Orders',
                    'data' => array_values($counts),
                    'backgroundColor' => 'rgba(251, 191, 36, 0.2)', // amber
                    'borderColor' => 'rgb(251, 191, 36)',
                    'borderWidth' => 2,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $dates,
        ];
    }
    
    protected function getType(): string
    {
        return 'line';
    }
}