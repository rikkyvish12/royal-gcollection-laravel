<?php

namespace App\Livewire;

use Livewire\Component;

class HomePage extends Component
{
    public function render()
    {
        return view('livewire.home-page', [
            'categories' => \App\Models\Category::all(),
            'featuredProducts' => \App\Models\Product::latest()->take(8)->get(),
        ]);
    }
}
