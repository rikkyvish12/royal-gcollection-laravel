<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            {{ static::$heading }}
        </x-slot>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Page</th>
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">URL</th>
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700 text-right">Total Views</th>
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700 text-right">Unique Visitors</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $analytics = app(\App\Services\AnalyticsService::class);
                        $popularPages = $analytics->getPopularPages(30, 10);
                    @endphp
                    
                    @forelse($popularPages as $page)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-3 px-4 text-sm text-gray-900 max-w-xs truncate">
                                {{ $page['page_title'] }}
                            </td>
                            <td class="py-3 px-4 text-sm text-gray-500 max-w-xs truncate" title="{{ $page['url'] }}">
                                {{ parse_url($page['url'], PHP_URL_PATH) }}
                            </td>
                            <td class="py-3 px-4 text-sm text-right font-semibold text-primary-600">
                                {{ number_format($page['views']) }}
                            </td>
                            <td class="py-3 px-4 text-sm text-right text-gray-700">
                                {{ number_format($page['unique_visitors']) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-8 px-4 text-center text-gray-500">
                                No page views data available yet. Analytics tracking will start collecting data once visitors access your site.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
