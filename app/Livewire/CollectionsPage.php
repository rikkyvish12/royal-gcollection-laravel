<?php

namespace App\Livewire;

use Livewire\Component;

class CollectionsPage extends Component
{
    public function render()
    {
        // SEO Meta
        $title = 'Luxury Watch Collection Guide | Expert Reviews & Buying Tips India - Royal Collection';
        $metaDescription = 'Expert guides on choosing luxury watches in India. Read reviews of Rolex, Omega, TAG Heuer & more. Learn about watch movements, styling tips, and investment advice.';
        $metaKeywords = 'luxury watch guide, how to buy luxury watch, watch collecting tips, rolex guide, omega watches, best luxury watches india, watch reviews';
        
        // Canonical URL
        $canonicalUrl = url('/collections');
        
        // JSON-LD Schema for Article
        $schema = [
            '@context' => 'https://schema.org/',
            '@type' => 'Blog',
            'name' => 'Royal Collection - Luxury Watch Guides & Reviews',
            'description' => $metaDescription,
            'url' => $canonicalUrl,
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'Royal Collection',
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => url('/')
                ]
            ]
        ];
        
        return view('livewire.collections-page', [
            'title' => $title,
            'metaDescription' => $metaDescription,
            'metaKeywords' => $metaKeywords,
            'canonicalUrl' => $canonicalUrl,
            'schema' => json_encode($schema)
        ]);
    }
}
