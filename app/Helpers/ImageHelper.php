<?php

if (!function_exists('optimized_image')) {
    /**
     * Generate optimized image HTML
     * 
     * @param string $imageUrl
     * @param string $alt
     * @param array $attributes
     * @return string
     */
    function optimized_image($imageUrl, $alt = '', $attributes = []) {
        // Generate optimized image URL
        $optimizedUrl = $imageUrl;
        if (!str_starts_with($imageUrl, 'http')) {
            $pathInfo = pathinfo($imageUrl);
            $optimizedPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '-optimized.webp';
            if (file_exists(storage_path('app/public/' . $optimizedPath))) {
                $optimizedUrl = asset($optimizedPath);
            }
        }
        
        // Build attributes
        $attrs = 'src="' . e($optimizedUrl) . '"';
        $attrs .= ' alt="' . e($alt) . '"';
        $attrs .= ' loading="lazy"';
        $attrs .= ' decoding="async"';
        
        if (is_array($attributes)) {
            foreach ($attributes as $key => $value) {
                $attrs .= ' ' . $key . '="' . e($value) . '"';
            }
        }
        
        return '<img ' . $attrs . '>';
    }
}
