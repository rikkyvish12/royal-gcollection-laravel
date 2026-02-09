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
        return view('livewire.product-detail-page');
    }
}
