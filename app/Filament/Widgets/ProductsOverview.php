<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProductsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $lowStockProducts = Product::where('stock_quantity', '<=', 5)->count();
        
        return [
            Stat::make('Total Products', Product::count())
                ->description('Products in catalog')
                ->descriptionIcon('heroicon-m-archive-box')
                ->color('primary'),
            
            Stat::make('Low Stock Items', $lowStockProducts)
                ->description('Products with 5 or fewer items')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color($lowStockProducts > 0 ? 'danger' : 'success'),
            
            Stat::make('Categories', \App\Models\Category::count())
                ->description('Product categories')
                ->descriptionIcon('heroicon-m-tag')
                ->color('info'),
            
            Stat::make('Super Categories', \App\Models\SuperCategory::count())
                ->description('Main product categories')
                ->descriptionIcon('heroicon-m-folder')
                ->color('warning'),
        ];
    }
}