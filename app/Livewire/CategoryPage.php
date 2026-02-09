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
        return view('livewire.category-page', [
            'products' => $this->category->products,
        ]);
    }
}
