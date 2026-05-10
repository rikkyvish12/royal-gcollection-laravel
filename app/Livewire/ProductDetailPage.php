<?php

namespace App\Livewire;

use Livewire\Component;

class ProductDetailPage extends Component
{
    public $product;
    public $quantity = 1;

    public function mount($id)
    {
        $this->product = \App\Models\Product::findOrFail($id);
    }

    public function addToCart()
    {
        // We'll use a session-based cart or a package later
        $cart = session()->get('cart', []);
        $id = $this->product->id;

        if(isset($cart[$id])) {
            $cart[$id]['quantity'] += $this->quantity;
        } else {
            $cart[$id] = [
                "name" => $this->product->name,
                "quantity" => $this->quantity,
                "price" => $this->product->price,
                "image" => isset($this->product->images[0]) ? $this->product->images[0] : 'https://via.placeholder.com/200'
            ];
        }

        session()->put('cart', $cart);
        $this->dispatch('cart-updated');
        session()->flash('success', 'Product added to cart successfully!');
    }

    public function render()
    {
        $productName = $this->product->name;
        $productBrand = $this->product->brand;
        $productPrice = $this->product->price;
        $productDescription = $this->product->description;
        $productImage = isset($this->product->images[0]) ? $this->product->images[0] : 'https://via.placeholder.com/1200';
        $productImageUrl = str_starts_with($productImage, 'http') ? $productImage : asset($productImage);
        
        // SEO Meta
        $title = "{$productBrand} {$productName} | Luxury Watches India - Royal Collection";
        $metaDescription = substr($productDescription, 0, 150) . " | Shop premium {$productBrand} watches at Royal Collection India. Lifetime warranty & secure shipping.";
        $metaKeywords = strtolower("{$productBrand}, {$productName}, luxury watch, premium timepiece, buy watch online India");
        
        // Open Graph
        $ogTitle = $title;
        $ogDescription = $metaDescription;
        $ogImage = $productImageUrl;
        $ogType = 'product';
        
        // Canonical URL
        $canonicalUrl = route('product.detail', $this->product->id);
        
        // JSON-LD Schema
        $schema = [
            '@context' => 'https://schema.org/',
            '@type' => 'Product',
            'name' => $productName,
            'image' => $productImageUrl,
            'description' => $productDescription,
            'brand' => [
                '@type' => 'Brand',
                'name' => $productBrand
            ],
            'offers' => [
                '@type' => 'Offer',
                'url' => $canonicalUrl,
                'priceCurrency' => 'INR',
                'price' => $productPrice,
                'availability' => $this->product->stock_quantity > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
                'seller' => [
                    '@type' => 'Organization',
                    'name' => 'Royal Collection'
                ]
            ]
        ];
        
        return view('livewire.product-detail-page', [
            'title' => $title,
            'metaDescription' => $metaDescription,
            'metaKeywords' => $metaKeywords,
            'ogTitle' => $ogTitle,
            'ogDescription' => $ogDescription,
            'ogImage' => $ogImage,
            'ogType' => $ogType,
            'canonicalUrl' => $canonicalUrl,
            'schema' => json_encode($schema)
        ]);
    }
}
