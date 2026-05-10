<?php

namespace App\Livewire;

use Livewire\Component;

class CategoryPage extends Component
{
    public $category;

    public function mount($slug)
    {
        $this->category = \App\Models\Category::where('slug', $slug)->with('products')->firstOrFail();
    }

    public function render()
    {
        $categoryName = $this->category->name;
        $categoryDescription = $this->category->description ?? "Shop luxury watches in the {$categoryName} category";
        
        // SEO Meta
        $title = "{$categoryName} Luxury Watches | Premium Timepieces India - Royal Collection";
        $metaDescription = substr($categoryDescription, 0, 150) . " | Explore our curated collection of {$categoryName} watches. Free shipping & lifetime warranty across India.";
        $metaKeywords = strtolower("{$categoryName}, luxury watches, premium watches, {$categoryName} watches india, buy watches online");
        
        // Canonical URL
        $canonicalUrl = route('category', $this->category->slug);
        
        // JSON-LD Schema
        $schema = [
            '@context' => 'https://schema.org/',
            '@type' => 'CollectionPage',
            'name' => $title,
            'description' => $metaDescription,
            'url' => $canonicalUrl
        ];
        
        return view('livewire.category-page', [
            'products' => $this->category->products,
            'title' => $title,
            'metaDescription' => $metaDescription,
            'metaKeywords' => $metaKeywords,
            'canonicalUrl' => $canonicalUrl,
            'schema' => json_encode($schema)
        ]);
    }
}
