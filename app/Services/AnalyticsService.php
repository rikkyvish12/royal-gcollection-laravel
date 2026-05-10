<?php

namespace App\Services;

use App\Models\PageView;
use App\Models\Visitor;
use Illuminate\Support\Facades\DB;

class AnalyticsService
{
    /**
     * Get overview statistics
     */
    public function getOverviewStats(int $days = 30): array
    {
        $startDate = now()->subDays($days);

        return [
            'total_visitors' => Visitor::where('first_visit', '>=', $startDate)->count(),
            'total_page_views' => PageView::where('viewed_at', '>=', $startDate)->count(),
            'unique_visitors' => Visitor::where('last_visit', '>=', $startDate)->distinct('session_id')->count('session_id'),
            'avg_page_views_per_visit' => round(Visitor::where('last_visit', '>=', $startDate)->avg('page_views') ?? 0, 2),
            'avg_session_duration' => $this->getAverageSessionDuration($days),
        ];
    }

    /**
     * Get visitors trend data
     */
    public function getVisitorsTrend(int $days = 30): array
    {
        $visitors = Visitor::selectRaw('DATE(first_visit) as date, COUNT(*) as count')
            ->where('first_visit', '>=', now()->subDays($days))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $pageViews = PageView::selectRaw('DATE(viewed_at) as date, COUNT(*) as count')
            ->where('viewed_at', '>=', now()->subDays($days))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $dates = [];
        $visitorCounts = [];
        $pageViewCounts = [];

        $period = new \DatePeriod(
            now()->subDays($days)->startOfDay(),
            new \DateInterval('P1D'),
            now()->endOfDay()
        );

        foreach ($period as $date) {
            $dateKey = $date->format('Y-m-d');
            $dates[] = $date->format('M d');
            $visitorCounts[$dateKey] = 0;
            $pageViewCounts[$dateKey] = 0;
        }

        foreach ($visitors as $record) {
            $dateKey = $record->date;
            if (isset($visitorCounts[$dateKey])) {
                $visitorCounts[$dateKey] = $record->count;
            }
        }

        foreach ($pageViews as $record) {
            $dateKey = $record->date;
            if (isset($pageViewCounts[$dateKey])) {
                $pageViewCounts[$dateKey] = $record->count;
            }
        }

        return [
            'labels' => $dates,
            'visitors' => array_values($visitorCounts),
            'page_views' => array_values($pageViewCounts),
        ];
    }

    /**
     * Get most popular pages
     */
    public function getPopularPages(int $days = 30, int $limit = 10): array
    {
        return PageView::selectRaw('url, COUNT(*) as views, COUNT(DISTINCT visitor_id) as unique_visitors')
            ->where('viewed_at', '>=', now()->subDays($days))
            ->groupBy('url')
            ->orderByDesc('views')
            ->limit($limit)
            ->get()
            ->map(function ($page) {
                $page->page_title = $this->getPageTitle($page->url);
                return $page;
            })
            ->toArray();
    }

    /**
     * Get traffic sources
     */
    public function getTrafficSources(int $days = 30, int $limit = 10): array
    {
        return Visitor::selectRaw('referrer_domain, COUNT(*) as visitors')
            ->where('first_visit', '>=', now()->subDays($days))
            ->whereNotNull('referrer_domain')
            ->groupBy('referrer_domain')
            ->orderByDesc('visitors')
            ->limit($limit)
            ->get()
            ->toArray();
    }

    /**
     * Get device breakdown
     */
    public function getDeviceBreakdown(int $days = 30): array
    {
        return Visitor::selectRaw('device_type, COUNT(*) as count')
            ->where('last_visit', '>=', now()->subDays($days))
            ->groupBy('device_type')
            ->get()
            ->pluck('count', 'device_type')
            ->toArray();
    }

    /**
     * Get browser breakdown
     */
    public function getBrowserBreakdown(int $days = 30): array
    {
        return Visitor::selectRaw('browser, COUNT(*) as count')
            ->where('last_visit', '>=', now()->subDays($days))
            ->groupBy('browser')
            ->orderByDesc('count')
            ->get()
            ->pluck('count', 'browser')
            ->toArray();
    }

    /**
     * Get OS breakdown
     */
    public function getOSBreakdown(int $days = 30): array
    {
        return Visitor::selectRaw('os, COUNT(*) as count')
            ->where('last_visit', '>=', now()->subDays($days))
            ->groupBy('os')
            ->orderByDesc('count')
            ->get()
            ->pluck('count', 'os')
            ->toArray();
    }

    /**
     * Get peak hours
     */
    public function getPeakHours(int $days = 30): array
    {
        $data = PageView::selectRaw('HOUR(viewed_at) as hour, COUNT(*) as views')
            ->where('viewed_at', '>=', now()->subDays($days))
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();

        $hours = array_fill(0, 24, 0);
        
        foreach ($data as $record) {
            $hours[$record->hour] = $record->views;
        }

        return [
            'labels' => array_map(fn($h) => sprintf('%02d:00', $h), range(0, 23)),
            'data' => array_values($hours),
        ];
    }

    /**
     * Get average session duration
     */
    private function getAverageSessionDuration(int $days = 30): string
    {
        $visitors = Visitor::where('last_visit', '>=', now()->subDays($days))
            ->where('page_views', '>', 1)
            ->get();

        if ($visitors->isEmpty()) {
            return '0m';
        }

        $totalDuration = 0;
        $count = 0;

        foreach ($visitors as $visitor) {
            $duration = $visitor->last_visit->timestamp - $visitor->first_visit->timestamp;
            if ($duration > 0 && $duration < 3600) { // Less than 1 hour
                $totalDuration += $duration;
                $count++;
            }
        }

        if ($count === 0) {
            return '0m';
        }

        $avgDuration = $totalDuration / $count;
        $minutes = floor($avgDuration / 60);
        $seconds = $avgDuration % 60;

        return sprintf('%dm %ds', $minutes, $seconds);
    }

    /**
     * Get friendly page title from URL
     */
    private function getPageTitle(string $url): string
    {
        $parsed = parse_url($url);
        $path = $parsed['path'] ?? '/';
        
        if ($path === '/') {
            return 'Home Page';
        }

        $segments = explode('/', trim($path, '/'));
        $lastSegment = end($segments);
        
        return ucwords(str_replace(['-', '_'], ' ', $lastSegment));
    }

    /**
     * Get today's live visitors (active in last 5 minutes)
     */
    public function getLiveVisitors(): int
    {
        return Visitor::where('last_visit', '>=', now()->subMinutes(5))->count();
    }

    /**
     * Get today's stats
     */
    public function getTodayStats(): array
    {
        $today = now()->startOfDay();

        return [
            'visitors' => Visitor::where('last_visit', '>=', $today)->count(),
            'page_views' => PageView::where('viewed_at', '>=', $today)->count(),
            'live_now' => $this->getLiveVisitors(),
        ];
    }
}
