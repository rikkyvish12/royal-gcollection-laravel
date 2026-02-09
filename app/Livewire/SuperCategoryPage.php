<?php

namespace App\Livewire;

use App\Models\SuperCategory;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class SuperCategoryPage extends Component
{
    use WithPagination;

    public $superCategorySlug;
    public $selectedCategories = [];
    public $selectedBrands = [];
    public $minPrice = 0;
    public $maxPrice = 1000000;
    public $priceRange = [0, 1000000];

    protected $queryString = [
        'selectedCategories' => ['except' => []],
        'selectedBrands' => ['except' => []],
        'minPrice' => ['except' => 0],
        'maxPrice' => ['except' => 1000000],
    ];

    public function mount($slug)
    {
        $this->superCategorySlug = $slug;
        $this->priceRange = [$this->minPrice, $this->maxPrice];
    }

    public function toggleCategory($categoryId)
    {
        if (in_array($categoryId, $this->selectedCategories)) {
            $this->selectedCategories = array_values(array_diff($this->selectedCategories, [$categoryId]));
        } else {
            $this->selectedCategories[] = $categoryId;
        }
        $this->resetPage();
    }

    public function toggleBrand($brand)
    {
        if (in_array($brand, $this->selectedBrands)) {
            $this->selectedBrands = array_values(array_diff($this->selectedBrands, [$brand]));
        } else {
            $this->selectedBrands[] = $brand;
        }
        $this->resetPage();
    }

    public function applyPriceFilter()
    {
        $this->minPrice = $this->priceRange[0];
        $this->maxPrice = $this->priceRange[1];
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->selectedCategories = [];
        $this->selectedBrands = [];
        $this->minPrice = 0;
        $this->maxPrice = 1000000;
        $this->priceRange = [0, 1000000];
        $this->resetPage();
    }

    public function render()
    {
        $superCategory = SuperCategory::where('slug', $this->superCategorySlug)->firstOrFail();
        
        // Get categories under this super category
        $categories = Category::where('super_category_id', $superCategory->id)->get();
        
        // Get all brands for products in this super category
        $allBrands = Product::whereHas('category', function($query) use ($superCategory) {
            $query->where('super_category_id', $superCategory->id);
        })
        ->select('brand')
        ->distinct()
        ->whereNotNull('brand')
        ->orderBy('brand')
        ->pluck('brand')
        ->toArray();

        // Build products query
        $query = Product::whereHas('category', function($q) use ($superCategory) {
            $q->where('super_category_id', $superCategory->id);
        });

        // Filter by selected categories
        if (!empty($this->selectedCategories)) {
            $query->whereIn('category_id', $this->selectedCategories);
        }

        // Filter by selected brands
        if (!empty($this->selectedBrands)) {
            $query->whereIn('brand', $this->selectedBrands);
        }

        // Filter by price range
        $query->whereBetween('price', [$this->minPrice, $this->maxPrice]);

        $products = $query->with('category')->orderBy('name')->paginate(12);

        return view('livewire.super-category-page', [
            'superCategory' => $superCategory,
            'categories' => $categories,
            'allBrands' => $allBrands,
            'products' => $products,
        ])->layout('components.layouts.app');
    }
}
