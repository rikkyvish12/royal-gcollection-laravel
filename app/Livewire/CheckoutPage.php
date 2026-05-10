<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\WhatsAppService;

class CheckoutPage extends Component
{
    public $shipping_address;
    public $payment_method = 'COD';
    public $cartItems = [];
    public $total = 0;
    public $whatsappOrderUrl = '';

    public function mount()
    {
        $this->cartItems = session()->get('cart', []);
        if(empty($this->cartItems)) {
            return redirect()->route('cart');
        }
        $this->calculateTotal();
        $this->generateWhatsAppOrderUrl();
    }

    public function calculateTotal()
    {
        $this->total = 0;
        foreach($this->cartItems as $item) {
            $this->total += $item['price'] * $item['quantity'];
        }
    }

    public function generateWhatsAppOrderUrl()
    {
        $whatsAppService = new WhatsAppService();
        $this->whatsappOrderUrl = $whatsAppService->generateOrderUrl(
            $this->cartItems,
            $this->total,
            $this->shipping_address ?? 'Not provided yet',
            $this->payment_method
        );
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'shipping_address' || $propertyName === 'payment_method') {
            $this->generateWhatsAppOrderUrl();
        }
    }

    public function placeOrder()
    {
        $this->validate([
            'shipping_address' => 'required|min:10',
            'payment_method' => 'required'
        ]);

        $user = auth()->user();

        $order = \App\Models\Order::create([
            'user_id' => $user->id,
            'total_amount' => $this->total,
            'payment_status' => $this->payment_method == 'COD' ? 'Pending' : 'Success', // Simplified for demo
            'payment_method' => $this->payment_method,
            'shipping_address' => $this->shipping_address
        ]);

        foreach($this->cartItems as $productId => $item) {
            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }

        session()->forget('cart');

        if($this->payment_method == 'Razorpay') {
            // Placeholder for Razorpay Order Creation
            /*
            $api = new \Razorpay\Api\Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $razorpayOrder = $api->order->create([
                'receipt' => $order->id,
                'amount' => $this->total * 100, // in paise
                'currency' => 'INR'
            ]);
            $order->update(['razorpay_order_id' => $razorpayOrder['id']]);
            */
            return redirect()->route('home')->with('success', 'Order placed! (Razorpay Payment ID generated - logic placeholder)');
        }

        return redirect()->route('home')->with('success', 'Order placed successfully with COD!');
    }

    public function render()
    {
        return view('livewire.checkout-page');
    }
}
