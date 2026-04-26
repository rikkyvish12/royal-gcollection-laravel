<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UsersOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('Registered users')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),
            
            Stat::make('Admin Users', User::where('is_admin', true)->count())
                ->description('Administrative accounts')
                ->descriptionIcon('heroicon-m-shield-check')
                ->color('info'),
            
            Stat::make('Regular Users', User::where('is_admin', false)->count())
                ->description('Customer accounts')
                ->descriptionIcon('heroicon-m-user')
                ->color('success'),
            
            Stat::make('Users with Mobile', User::whereNotNull('mobile_number')->count())
                ->description('Users with verified mobile numbers')
                ->descriptionIcon('heroicon-m-phone')
                ->color('warning'),
        ];
    }
}