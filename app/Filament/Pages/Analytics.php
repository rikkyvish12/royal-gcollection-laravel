<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Analytics extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static string $view = 'filament.pages.analytics';
    protected static ?string $navigationLabel = 'Analytics';
    protected static ?string $title = 'Website Analytics';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationGroup = 'Analytics';
}
