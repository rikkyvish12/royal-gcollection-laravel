<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Services\ImageOptimizationService;
use Illuminate\Support\Facades\Storage;

class OptimizeProductImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:optimize {--width=1200 : Maximum width for optimized images} {--quality=80 : Image quality (1-100)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Optimize all product images for better SEO and performance';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting image optimization...');
        
        $products = Product::all();
        $total = $products->count();
        $optimized = 0;
        $errors = 0;

        $this->withProgressBar($total, function ($product) use (&$optimized, &$errors) {
            if (empty($product->images)) {
                return;
            }

            foreach ($product->images as $index => $imagePath) {
                // Skip external URLs
                if (str_starts_with($imagePath, 'http')) {
                    continue;
                }

                $fullPath = storage_path('app/public/' . $imagePath);
                
                if (!file_exists($fullPath)) {
                    $this->warn("Image not found: {$imagePath}");
                    $errors++;
                    continue;
                }

                // Generate optimized path
                $pathInfo = pathinfo($imagePath);
                $optimizedPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '-optimized.webp';
                $optimizedFullPath = storage_path('app/public/' . $optimizedPath);

                // Optimize image
                $width = $this->option('width');
                $quality = $this->option('quality');

                if (ImageOptimizationService::optimizeImage($fullPath, $optimizedFullPath, $width, null, $quality)) {
                    $originalSize = ImageOptimizationService::getFileSize($fullPath);
                    $optimizedSize = ImageOptimizationService::getFileSize($optimizedFullPath);
                    
                    $this->line("✓ Optimized: {$imagePath} ({$originalSize} → {$optimizedSize})");
                    $optimized++;
                } else {
                    $this->error("Failed to optimize: {$imagePath}");
                    $errors++;
                }
            }
        });

        $this->newLine();
        $this->info("Optimization complete!");
        $this->info("Total products: {$total}");
        $this->info("Images optimized: {$optimized}");
        $this->info("Errors: {$errors}");

        return Command::SUCCESS;
    }
}
