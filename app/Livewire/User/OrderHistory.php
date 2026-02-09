<?php

namespace App\Livewire\User;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OrderHistory extends Component
{
    public function render()
    {
        $orders = Order::where('user_id', Auth::id())
                       ->with('orderItems.product')
                       ->latest()
                       ->get();

        return view('livewire.user.order-history', [
            'orders' => $orders,
        ])->layout('components.layouts.app');
    }
}
