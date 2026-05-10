<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageOptimizationService
{
    /**
     * Optimize and resize an image
     * 
     * @param string $sourcePath Path to the source image
     * @param string $destinationPath Path to save the optimized image
     * @param int|null $width Target width (null to maintain aspect ratio)
     * @param int|null $height Target height (null to maintain aspect ratio)
     * @param int $quality Image quality (1-100)
     * @return bool
     */
    public static function optimizeImage($sourcePath, $destinationPath, $width = null, $height = null, $quality = 80)
    {
        try {
            $manager = new ImageManager(new Driver());
            $image = $manager->read($sourcePath);

            // Resize if dimensions provided
            if ($width || $height) {
                $image->scale(width: $width, height: $height);
            }

            // Optimize and save
            $image->toWebp($quality)->save($destinationPath);

            return true;
        } catch (\Exception $e) {
            \Log::error('Image optimization failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Generate multiple image sizes for responsive images
     * 
     * @param string $sourcePath Path to the source image
     * @param string $destinationDir Directory to save optimized images
     * @param array $sizes Array of widths to generate [480, 768, 1024, 1920]
     * @param int $quality Image quality
     * @return array Array of generated file paths
     */
    public static function generateResponsiveImages($sourcePath, $destinationDir, $sizes = [480, 768, 1024, 1920], $quality = 80)
    {
        $generatedFiles = [];

        if (!file_exists($destinationDir)) {
            mkdir($destinationDir, 0755, true);
        }

        foreach ($sizes as $width) {
            $filename = pathinfo($sourcePath, PATHINFO_FILENAME) . "-{$width}w.webp";
            $destinationPath = rtrim($destinationDir, '/') . '/' . $filename;

            if (self::optimizeImage($sourcePath, $destinationPath, $width, null, $quality)) {
                $generatedFiles[$width] = $destinationPath;
            }
        }

        return $generatedFiles;
    }

    /**
     * Generate srcset attribute value for responsive images
     * 
     * @param string $baseUrl Base URL for the images
     * @param string $filename Original filename
     * @param array $sizes Available widths
     * @return string
     */
    public static function generateSrcset($baseUrl, $filename, $sizes = [480, 768, 1024, 1920])
    {
        $srcset = [];
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $baseFilename = pathinfo($filename, PATHINFO_FILENAME);

        foreach ($sizes as $width) {
            $optimizedFilename = "{$baseFilename}-{$width}w.webp";
            $url = rtrim($baseUrl, '/') . '/' . $optimizedFilename;
            $srcset[] = "{$url} {$width}w";
        }

        return implode(', ', $srcset);
    }

    /**
     * Get file size in human-readable format
     * 
     * @param string $filePath
     * @return string
     */
    public static function getFileSize($filePath)
    {
        if (!file_exists($filePath)) {
            return '0 B';
        }

        $bytes = filesize($filePath);
        $units = ['B', 'KB', 'MB', 'GB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Compress image without resizing
     * 
     * @param string $sourcePath
     * @param string $destinationPath
     * @param int $quality
     * @return bool
     */
    public static function compressImage($sourcePath, $destinationPath, $quality = 75)
    {
        return self::optimizeImage($sourcePath, $destinationPath, null, null, $quality);
    }
}
