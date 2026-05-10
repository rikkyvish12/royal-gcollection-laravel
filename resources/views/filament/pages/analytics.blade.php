<x-filament-panels::page>
    {{-- Overview Stats --}}
    <div class="grid grid-cols-1 gap-6">
        @livewire('analytics-overview')
    </div>

    {{-- Charts Row 1 --}}
    <div class="grid grid-cols-1 gap-6 mt-6">
        @livewire('visitors-trend-chart')
    </div>

    {{-- Popular Pages Table --}}
    <div class="grid grid-cols-1 gap-6 mt-6">
        @livewire('popular-pages-table')
    </div>

    {{-- Charts Row 2 - Two Columns --}}
    <div class="grid grid-cols-1 gap-6 mt-6 lg:grid-cols-2">
        @livewire('device-breakdown-chart')
        @livewire('browser-breakdown-chart')
    </div>

    {{-- Charts Row 3 - Two Columns --}}
    <div class="grid grid-cols-1 gap-6 mt-6 lg:grid-cols-2">
        @livewire('traffic-sources-chart')
        @livewire('peak-hours-chart')
    </div>
</x-filament-panels::page>
