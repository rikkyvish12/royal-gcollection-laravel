<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Services\WhatsAppService;

$service = new WhatsAppService();
$result = $service->sendOtp('8286608983', '123456');
echo "WhatsApp Service Result: " . ($result ? 'Success' : 'Failed') . "\n";

// Also test the database connection
try {
    $db = DB::connection()->getPdo();
    echo "Database connection: OK\n";
} catch (Exception $e) {
    echo "Database connection failed: " . $e->getMessage() . "\n";
}