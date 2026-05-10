<?php

namespace App\Filament\Widgets;

use App\Services\AnalyticsService;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AnalyticsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $analytics = app(AnalyticsService::class);
        $todayStats = $analytics->getTodayStats();
        $overviewStats = $analytics->getOverviewStats(30);

        return [
            Stat::make('Live Visitors Now', $todayStats['live_now'])
                ->description('Active in last 5 minutes')
                ->descriptionIcon('heroicon-m-signal')
                ->color('success'),
            
            Stat::make('Today\'s Visitors', $todayStats['visitors'])
                ->description('Unique visitors today')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),
            
            Stat::make('Today\'s Page Views', $todayStats['page_views'])
                ->description('Total pages viewed today')
                ->descriptionIcon('heroicon-m-eye')
                ->color('info'),
            
            Stat::make('Avg Session Duration', $overviewStats['avg_session_duration'])
                ->description('Last 30 days average')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
        ];
    }
}
