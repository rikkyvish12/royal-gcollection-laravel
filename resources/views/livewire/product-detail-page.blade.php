<div class="animate-fadeIn max-w-7xl mx-auto px-6 py-20">
    <!-- JSON-LD Schema Markup -->
    @if(isset($schema))
        <script type="application/ld+json">
            {!! $schema !!}
        </script>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-24">
        <!-- Image Gallery -->
        <div class="relative group">
            <div class="aspect-square overflow-hidden bg-white shadow-2xl">
                @php
                    $productImage = isset($product->images[0]) ? $product->images[0] : 'https://via.placeholder.com/1200';
                    $productImageUrl = str_starts_with($productImage, 'http') ? $productImage : asset($productImage);
                @endphp
                <img src="{{ $productImageUrl }}" 
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

                <a href="{{ $whatsappEnquiryUrl }}" target="_blank" 
                   class="w-full bg-green-500 text-white h-16 text-[10px] font-bold tracking-[0.4em] uppercase hover:bg-green-600 transition-all duration-500 shadow-xl flex items-center justify-center space-x-3">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    <span>Enquire on WhatsApp</span>
                </a>
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
