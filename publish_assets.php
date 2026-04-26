<?php

require __DIR__.'/vendor/autoload.php';

// Set up the application properly
$app = require_once __DIR__.'/bootstrap/app.php';

// Bootstrap the application
$app->bootstrapWith([
    \Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables::class,
    \Illuminate\Foundation\Bootstrap\LoadConfiguration::class,
    \Illuminate\Foundation\Bootstrap\HandleExceptions::class,
    \Illuminate\Foundation\Bootstrap\RegisterFacades::class,
    \Illuminate\Foundation\Bootstrap\RegisterProviders::class,
    \Illuminate\Foundation\Bootstrap\BootProviders::class,
]);

// Get the Artisan console kernel
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

// Run the filament:assets command
echo "Publishing Filament assets...\n";
$kernel->call('filament:assets');
echo "Assets published successfully!\n";