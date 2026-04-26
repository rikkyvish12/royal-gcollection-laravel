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
        
        return view('livewire.home-page', [
            'categories' => $categories->get(),
            'products' => $products->get(),
            'featuredProducts' => \App\Models\Product::latest()->take(8)->get(),
            'searchResults' => !empty($this->search),
        ]);
    }
}
