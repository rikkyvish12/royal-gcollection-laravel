<div class="animate-fadeIn max-w-7xl mx-auto px-6 py-20">
    <!-- JSON-LD Schema Markup -->
    @if(isset($schema))
        <script type="application/ld+json">
            {!! $schema !!}
        </script>
    @endif

    <div class="flex flex-col items-center mb-24 space-y-6">
        <p class="text-royal-gold text-[10px] tracking-[0.5em] uppercase font-bold">Maison Selection</p>
        <h2 class="font-serif text-5xl md:text-7xl text-center gold-text-gradient">{{ $category->name }}</h2>
        <div class="w-24 h-px bg-royal-gold"></div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
        @forelse($products as $product)
            <div class="group">
                <div class="relative aspect-[4/5] overflow-hidden bg-stone-100 mb-8 shadow-2xl">
                    @php
                        $productImage = isset($product->images[0]) ? $product->images[0] : 'https://via.placeholder.com/800';
                        $productImageUrl = str_starts_with($productImage, 'http') ? $productImage : asset($productImage);
                    @endphp
                    <img src="{{ $productImageUrl }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-all duration-1000">
                    
                    <div class="absolute inset-0 bg-royal-dark/90 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-700 p-8 text-center">
                        <div class="space-y-6">
                            <p class="text-stone-400 text-xs font-light italic leading-relaxed">
                                {{ Str::limit($product->description, 120) }}
                            </p>
                            <a href="{{ route('product.detail', $product->id) }}" class="inline-block px-10 py-4 border border-white text-white text-[10px] font-bold tracking-[0.3em] uppercase hover:bg-white hover:text-royal-dark transition-all duration-500">
                                View Piece
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-3">
                    <div class="flex justify-between items-baseline">
                        <h3 class="font-serif text-2xl tracking-wide">{{ $product->name }}</h3>
                        <p class="text-royal-gold font-light tracking-widest text-lg">₹{{ number_format($product->price, 2) }}</p>
                    </div>
                    <p class="text-stone-500 text-[10px] tracking-[0.3em] uppercase font-bold">{{ $product->brand }}</p>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-40 border border-dashed border-stone-200">
                <p class="font-serif text-2xl text-stone-400 italic">This archive is currently empty.</p>
                <a href="{{ route('home') }}" class="mt-8 inline-block text-royal-gold text-xs tracking-widest uppercase border-b border-royal-gold pb-2">Return to Salon</a>
            </div>
        @endforelse
    </div>
</div>
