<div class="animate-fadeIn max-w-5xl mx-auto px-6 py-20">
    <div class="flex flex-col items-center mb-16 space-y-4">
        <h2 class="font-serif text-4xl text-center uppercase tracking-widest">Your Collection</h2>
        <div class="w-24 h-px bg-royal-gold"></div>
    </div>

    @if(count($cartItems) > 0)
        <div class="bg-white shadow-2xl overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-stone-50 text-[10px] font-bold tracking-[0.3em] uppercase text-stone-500 border-b border-stone-100">
                        <th class="py-6 px-8">Piece</th>
                        <th class="py-6 px-8 text-center">Price</th>
                        <th class="py-6 px-8 text-center">Quantity</th>
                        <th class="py-6 px-8 text-right">Subtotal</th>
                        <th class="py-6 px-8"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @foreach($cartItems as $id => $item)
                        <tr class="group hover:bg-stone-50 transition-colors">
                            <td class="py-8 px-8">
                                <div class="flex items-center space-x-6">
                                    <img src="{{ $item['image'] }}" class="w-24 h-24 object-cover grayscale group-hover:grayscale-0 transition-all duration-500 shadow-lg">
                                    <span class="font-serif text-xl tracking-wide">{{ $item['name'] }}</span>
                                </div>
                            </td>
                            <td class="py-8 px-8 text-center font-light tracking-widest text-stone-500">₹{{ number_format($item['price'], 2) }}</td>
                            <td class="py-8 px-8 text-center font-bold">{{ $item['quantity'] }}</td>
                            <td class="py-8 px-8 text-right font-serif text-xl">₹{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                            <td class="py-8 px-8 text-right">
                                <button wire:click="removeItem({{ $id }})" class="text-stone-300 hover:text-red-800 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-16 flex flex-col md:flex-row justify-between items-center space-y-8 md:space-y-0">
            <div class="space-y-2">
                <p class="text-[10px] font-bold tracking-[0.5em] uppercase text-stone-400 text-center md:text-left">Estimated Value</p>
                <div class="text-5xl font-light font-serif tracking-tighter text-royal-dark">₹{{ number_format($total, 2) }}</div>
            </div>
            
            <a href="{{ route('checkout') }}" class="w-full md:w-auto px-16 py-6 bg-royal-dark text-white text-[10px] font-bold tracking-[0.4em] uppercase hover:bg-royal-gold hover:text-royal-dark transition-all duration-500 shadow-2xl">
                Enter Private Checkout
            </a>
        </div>
    @else
        <div class="text-center py-40 bg-white shadow-xl flex flex-col items-center space-y-8">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-stone-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <p class="font-serif text-2xl text-stone-400 italic">Your collection is currently empty.</p>
            <a href="{{ route('home') }}" class="px-12 py-4 border border-royal-dark text-royal-dark text-[10px] font-bold tracking-[0.3em] uppercase hover:bg-royal-dark hover:text-white transition-all">Continue Discovery</a>
        </div>
    @endif
</div>
