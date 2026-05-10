<?php

namespace App\Filament\Widgets;

use App\Services\AnalyticsService;
use Filament\Widgets\Widget;

class PopularPagesTable extends Widget
{
    protected static ?string $heading = 'Most Popular Pages (Last 30 Days)';
    protected static ?int $sort = 3;
    protected static string $view = 'filament.widgets.popular-pages-table';
}
