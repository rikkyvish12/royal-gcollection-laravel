<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;

class HomePage extends Component
{
    public $search = '';
    
    public function mount()
    {
        $this->search = request()->query('search', '');
    }
    
    public function render()
    {
        $categories = Category::query();
        $products = Product::query();
        
        if (!empty($this->search)) {
            $searchTerm = '%' . trim($this->search) . '%';
            $categories->where('name', 'LIKE', $searchTerm);
            $products->where(function($query) use ($searchTerm) {
                $query->where('name', 'LIKE', $searchTerm)
                      ->orWhere('brand', 'LIKE', $searchTerm);
            });
        }
        
        // SEO Meta for Homepage
        $isSearchResults = !empty($this->search);
        
        if ($isSearchResults) {
            $searchQuery = trim($this->search);
            $title = "Search Results for '{$searchQuery}' | Luxury Watches - Royal Collection";
            $metaDescription = "Browse luxury watches matching '{$searchQuery}'. Find premium timepieces from top brands at Royal Collection India.";
            $metaKeywords = strtolower("{$searchQuery}, luxury watches, premium watches, watch search");
        } else {
            $title = 'Royal Collection | Luxury Watches in India - Premium Timepieces & Designer Watches';
            $metaDescription = 'Discover exclusive luxury watches at Royal Collection. Shop premium timepieces from Rolex, Omega, TAG Heuer & more. Lifetime warranty, secure shipping across India.';
            $metaKeywords = 'luxury watches, premium watches, designer watches, rolex, omega, tag heuer, watch collection, buy watches online india';
        }
        
        // JSON-LD Schema for Organization
        $schema = [
            '@context' => 'https://schema.org/',
            '@type' => 'Organization',
            'name' => 'Royal Collection',
            'url' => url('/'),
            'logo' => asset('https://images.unsplash.com/photo-1614164185128-e4ec99c436d7?q=80&w=2070'),
            'description' => 'Premium luxury watch retailer in India',
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => '+91-XXX-XXX-XXXX',
                'contactType' => 'Customer Service'
            ]
        ];
        
        return view('livewire.home-page', [
            'categories' => $categories->get(),
            'products' => $products->get(),
            'featuredProducts' => \App\Models\Product::latest()->take(8)->get(),
            'searchResults' => $isSearchResults,
            'title' => $title,
            'metaDescription' => $metaDescription,
            'metaKeywords' => $metaKeywords,
            'canonicalUrl' => url('/'),
            'schema' => json_encode($schema)
        ]);
    }
}
