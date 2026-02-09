<?php

namespace App\Livewire;

use Livewire\Component;

class CartPage extends Component
{
    public $cartItems = [];
    public $total = 0;

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cartItems = session()->get('cart', []);
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total = 0;
        foreach($this->cartItems as $item) {
            $this->total += $item['price'] * $item['quantity'];
        }
    }

    public function removeItem($id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            $this->loadCart();
        }
    }

    public function render()
    {
        return view('livewire.cart-page');
    }
}
