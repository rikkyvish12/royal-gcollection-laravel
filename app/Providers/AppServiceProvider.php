<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Load helper functions
        require_once app_path('Helpers/ImageHelper.php');
        
        // Register Filament widgets as Livewire components for analytics page
        Livewire::component('analytics-overview', \App\Filament\Widgets\AnalyticsOverview::class);
        Livewire::component('visitors-trend-chart', \App\Filament\Widgets\VisitorsTrendChart::class);
        Livewire::component('popular-pages-table', \App\Filament\Widgets\PopularPagesTable::class);
        Livewire::component('device-breakdown-chart', \App\Filament\Widgets\DeviceBreakdownChart::class);
        Livewire::component('browser-breakdown-chart', \App\Filament\Widgets\BrowserBreakdownChart::class);
        Livewire::component('traffic-sources-chart', \App\Filament\Widgets\TrafficSourcesChart::class);
        Livewire::component('peak-hours-chart', \App\Filament\Widgets\PeakHoursChart::class);
    }
}
