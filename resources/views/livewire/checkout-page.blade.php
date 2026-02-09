<div class="grid grid-cols-1 md:grid-cols-2 gap-10">
    <div class="bg-white p-8 rounded-lg shadow-lg h-fit">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Shipping Details</h2>
        <form wire:submit.prevent="placeOrder">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Shipping Address</label>
                <textarea wire:model="shipping_address" class="w-full p-3 border rounded h-32" placeholder="Enter your full address here..."></textarea>
                @error('shipping_address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Payment Method</label>
                <div class="flex space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" wire:model="payment_method" value="COD" class="form-radio text-blue-600">
                        <span class="ml-2">Cash on Delivery (COD)</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" wire:model="payment_method" value="Razorpay" class="form-radio text-blue-600">
                        <span class="ml-2">Razorpay</span>
                    </label>
                </div>
                @error('payment_method') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-bold hover:bg-blue-700 transition">
                Place Order
            </button>
        </form>
    </div>

    <div class="bg-white p-8 rounded-lg shadow-lg h-fit">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Order Summary</h2>
        @foreach($cartItems as $item)
            <div class="flex justify-between items-center mb-4 pb-4 border-b">
                <div>
                    <p class="font-bold">{{ $item['name'] }}</p>
                    <p class="text-gray-500">Qty: {{ $item['quantity'] }}</p>
                </div>
                <p class="font-bold">₹{{ number_format($item['price'] * $item['quantity'], 2) }}</p>
            </div>
        @endforeach
        <div class="flex justify-between items-center mt-6 text-2xl font-bold">
            <span>Total</span>
            <span>₹{{ number_format($total, 2) }}</span>
        </div>
    </div>
</div>
