<?php

require __DIR__.'/vendor/autoload.php';

echo "Autoload file loaded\n";

if (class_exists('Illuminate\Foundation\Application')) {
    echo "Application class found\n";
} else {
    echo "Application class NOT found\n";
}

// Try to create the application
try {
    $app = Illuminate\Foundation\Application::configure(basePath: dirname(__DIR__))
        ->withRouting(
            web: __DIR__.'/routes/web.php',
            commands: __DIR__.'/routes/console.php',
            health: '/up',
        )
        ->withMiddleware(function (Illuminate\Foundation\Configuration\Middleware $middleware): void {
            //
        })
        ->withExceptions(function (Illuminate\Foundation\Configuration\Exceptions $exceptions): void {
            //
        })->create();
    
    echo "Application created successfully\n";
} catch (Exception $e) {
    echo "Error creating application: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
}