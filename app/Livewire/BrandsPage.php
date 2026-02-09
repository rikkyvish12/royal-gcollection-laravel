<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class BrandsPage extends Component
{
    use WithPagination;

    public $selectedBrands = [];
    public $minPrice = 0;
    public $maxPrice = 1000000;
    public $priceRange = [0, 1000000];

    protected $queryString = [
        'selectedBrands' => ['except' => []],
        'minPrice' => ['except' => 0],
        'maxPrice' => ['except' => 1000000],
    ];

    public function mount()
    {
        $this->priceRange = [$this->minPrice, $this->maxPrice];
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
        $this->selectedBrands = [];
        $this->minPrice = 0;
        $this->maxPrice = 1000000;
        $this->priceRange = [0, 1000000];
        $this->resetPage();
    }

    public function render()
    {
        // Get all unique brands
        $allBrands = Product::select('brand')
            ->distinct()
            ->whereNotNull('brand')
            ->orderBy('brand')
            ->pluck('brand')
            ->toArray();

        // Build query with filters
        $query = Product::query();

        if (!empty($this->selectedBrands)) {
            $query->whereIn('brand', $this->selectedBrands);
        }

        $query->whereBetween('price', [$this->minPrice, $this->maxPrice]);

        $products = $query->orderBy('brand')->orderBy('name')->paginate(12);

        return view('livewire.brands-page', [
            'allBrands' => $allBrands,
            'products' => $products,
        ])->layout('components.layouts.app');
    }
}
