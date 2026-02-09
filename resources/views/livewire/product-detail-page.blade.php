<div class="animate-fadeIn max-w-7xl mx-auto px-6 py-20">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-24">
        <!-- Image Gallery -->
        <div class="relative group">
            <div class="aspect-square overflow-hidden bg-white shadow-2xl">
                <img src="{{ isset($product->images[0]) ? $product->images[0] : 'https://via.placeholder.com/1200' }}" 
                     class="w-full h-full object-cover group-hover:scale-105 transition-all duration-1000">
            </div>
            
            <div class="absolute -bottom-10 -right-10 w-40 h-40 royal-gradient -z-10 opacity-20"></div>
            <div class="absolute -top-10 -left-10 w-40 h-40 bg-royal-gold -z-10 opacity-10"></div>
        </div>

        <!-- Product Info -->
        <div class="flex flex-col justify-center space-y-12">
            <div class="space-y-4">
                <p class="text-royal-gold text-xs font-bold tracking-[0.5em] uppercase">{{ $product->brand }}</p>
                <h1 class="font-serif text-5xl md:text-7xl leading-tight">{{ $product->name }}</h1>
                <div class="w-16 h-px bg-royal-gold"></div>
            </div>

            <p class="text-stone-500 font-light text-lg leading-relaxed italic font-serif">
                "{{ $product->description }}"
            </p>

            <div class="flex items-baseline space-x-6">
                <span class="text-5xl font-light tracking-tighter text-royal-dark">₹{{ number_format($product->price, 2) }}</span>
                <span class="text-stone-400 text-xs tracking-widest uppercase">Includes Vat & Shipping</span>
            </div>

            <div class="space-y-8 pt-8 border-t border-stone-200">
                <div class="flex items-center space-x-4">
                    <span class="text-[10px] font-bold tracking-[0.3em] uppercase text-stone-500">Status:</span>
                    @if($product->stock_quantity > 0)
                        <span class="text-[10px] font-bold tracking-[0.3em] uppercase text-green-600">Available in Salon</span>
                    @else
                        <span class="text-[10px] font-bold tracking-[0.3em] uppercase text-red-500">Sold to Archive</span>
                    @endif
                </div>

                @if(session()->has('success'))
                    <div class="bg-stone-900 text-white p-6 flex justify-between items-center animate-slideUp">
                        <span class="text-xs font-bold tracking-widest uppercase">{{ session('success') }}</span>
                        <a href="{{ route('cart') }}" class="text-royal-gold text-[10px] font-bold tracking-[0.2em] uppercase underline underline-offset-4">View Cart</a>
                    </div>
                @endif

                <div class="flex items-center space-x-6">
                    <div class="flex border border-stone-200 h-16">
                        <button wire:click="$set('quantity', {{ max(1, $quantity - 1) }})" class="px-6 hover:bg-stone-100 transition-colors">-</button>
                        <input type="number" wire:model="quantity" class="w-16 text-center border-none focus:ring-0 bg-transparent text-sm font-bold" readonly>
                        <button wire:click="$set('quantity', {{ $quantity + 1 }})" class="px-6 hover:bg-stone-100 transition-colors">+</button>
                    </div>
                    
                    <button wire:click="addToCart" 
                            class="flex-1 bg-royal-dark text-white h-16 text-[10px] font-bold tracking-[0.4em] uppercase hover:bg-royal-gold hover:text-royal-dark transition-all duration-500 shadow-xl active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed"
                            {{ $product->stock_quantity <= 0 ? 'disabled' : '' }}>
                        Add to Collection
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-8 text-[9px] tracking-[0.3em] uppercase font-bold text-stone-400">
                <div class="flex items-center space-x-3">
                    <svg class="h-4 w-4 text-royal-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    <span>Lifetime Warranty</span>
                </div>
                <div class="flex items-center space-x-3">
                    <svg class="h-4 w-4 text-royal-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    <span>Secure Packaging</span>
                </div>
            </div>
        </div>
    </div>
</div>
