<div class="animate-fadeIn">
    <!-- JSON-LD Schema Markup -->
    @if(isset($schema))
        <script type="application/ld+json">
            {!! $schema !!}
        </script>
    @endif

    <!-- Hero Section -->
    <section class="relative h-[85vh] flex items-center overflow-hidden royal-gradient">
        <div class="absolute inset-0 opacity-40">
            <img src="https://images.unsplash.com/photo-1614164185128-e4ec99c436d7?q=80&w=2070" alt="Luxury Background" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-royal-dark via-transparent to-transparent"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-6 w-full">
            <div class="max-w-2xl space-y-8">
                <h1 class="font-serif text-6xl md:text-8xl text-white leading-tight">
                    @if($searchResults)
                        Search Results
                    @else
                        Timeless <br>
                        <span class="gold-text-gradient italic">Elegance</span>
                    @endif
                </h1>
                @if($searchResults)
                    <p class="text-stone-400 text-lg md:text-xl font-light tracking-widest uppercase">
                        Showing results for "{{ request()->get('search') }}"
                    </p>
                @else
                    <p class="text-stone-400 text-lg md:text-xl font-light tracking-widest uppercase">
                        Exquisite timepieces for the <br>discerning connoisseur.
                    </p>
                @endif
                <div class="pt-8">
                    @if(!$searchResults)
                        <a href="#featured" class="inline-block px-12 py-5 border border-royal-gold text-royal-gold hover:bg-royal-gold hover:text-royal-dark transition-all duration-500 text-xs font-bold tracking-[0.4em] uppercase">
                            Discover Collection
                        </a>
                    @endif
                </div>
            </div>
        </div>
        
        @if(!$searchResults)
            <div class="absolute bottom-10 left-1/2 -translate-x-1/2 animate-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-royal-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </div>
        @endif
    </section>

    <div class="max-w-7xl mx-auto px-6 py-24 space-y-32">
        @if($searchResults)
            <!-- Search Results Section -->
            <section>
                <div class="flex flex-col items-center mb-16 space-y-4">
                    <h2 class="font-serif text-4xl text-center">Search Results</h2>
                    <div class="w-24 h-px bg-royal-gold"></div>
                </div>
                
                @if(count($categories) > 0 || count($products) > 0)
                    <!-- Categories Results -->
                    @if(count($categories) > 0)
                        <div class="mb-16">
                            <h3 class="font-serif text-2xl text-center mb-8 text-royal-dark">Categories</h3>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                                @foreach($categories as $category)
                                    <a href="{{ route('category', $category->slug) }}" class="group relative aspect-[3/4] overflow-hidden bg-stone-200">
                                        <img src="{{ $category->image ? (str_starts_with($category->image, 'http') ? $category->image : asset($category->image)) : 'https://via.placeholder.com/600x800' }}" 
                                             class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-1000">
                                        <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-all duration-500"></div>
                                        <div class="absolute inset-0 flex flex-col items-center justify-center p-6 border border-white/0 group-hover:border-white/20 transition-all duration-500 m-4">
                                            <h3 class="text-white font-serif text-2xl tracking-widest uppercase mb-2">{{ $category->name }}</h3>
                                            <span class="text-royal-gold text-[10px] tracking-[0.5em] uppercase opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-500">View Atelier</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    <!-- Product Results -->
                    @if(count($products) > 0)
                        <div class="mb-16">
                            <h3 class="font-serif text-2xl text-center mb-8 text-royal-dark">Products</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                                @foreach($products as $product)
                                    <div class="group">
                                        <div class="relative aspect-square overflow-hidden bg-stone-100 mb-6 shadow-xl">
                                            @php
                                                $productImage = isset($product->images[0]) ? $product->images[0] : 'https://via.placeholder.com/800';
                                                $productImageUrl = str_starts_with($productImage, 'http') ? $productImage : asset($productImage);
                                            @endphp
                                            <img src="{{ $productImageUrl }}" 
                                                 class="w-full h-full object-cover group-hover:scale-105 transition-all duration-700">
                                            
                                            <div class="absolute inset-0 bg-royal-dark/80 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500">
                                                <a href="{{ route('product.detail', $product->id) }}" class="px-8 py-3 bg-white text-royal-dark text-[10px] font-bold tracking-[0.3em] uppercase hover:bg-royal-gold transition-colors">
                                                    Enquire Detail
                                                </a>
                                            </div>
                                            
                                            @if($product->stock_quantity < 3)
                                                <div class="absolute top-4 left-4 bg-royal-gold text-royal-dark text-[8px] font-bold tracking-widest px-3 py-1 uppercase">
                                                    Rare Item
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <div class="text-center space-y-2">
                                            <p class="text-stone-400 text-[10px] tracking-[0.3em] uppercase font-bold">{{ $product->brand }}</p>
                                            <h3 class="font-serif text-xl tracking-wide group-hover:text-royal-gold transition-colors">{{ $product->name }}</h3>
                                            <p class="text-royal-gold font-light tracking-[0.2em]">₹{{ number_format($product->price, 2) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    @if(count($categories) === 0 && count($products) === 0)
                        <div class="text-center py-20">
                            <p class="text-2xl text-stone-600">No results found for "{{ request()->get('search') }}"</p>
                            <a href="{{ route('home') }}" class="mt-4 inline-block text-royal-gold hover:underline">Browse All Products</a>
                        </div>
                    @endif
                @else
                    <div class="text-center py-20">
                        <p class="text-2xl text-stone-600">No results found for "{{ request()->get('search') }}"</p>
                        <a href="{{ route('home') }}" class="mt-4 inline-block text-royal-gold hover:underline">Browse All Products</a>
                    </div>
                @endif
            </section>
        @else
            <!-- Categories Section -->
            <section>
                <div class="flex flex-col items-center mb-16 space-y-4">
                    <h2 class="font-serif text-4xl text-center">Curated Houses</h2>
                    <div class="w-24 h-px bg-royal-gold"></div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    @foreach($categories as $category)
                        <a href="{{ route('category', $category->slug) }}" class="group relative aspect-[3/4] overflow-hidden bg-stone-200">
                            <img src="{{ $category->image ? (str_starts_with($category->image, 'http') ? $category->image : asset($category->image)) : 'https://via.placeholder.com/600x800' }}" 
                                 class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-1000">
                            <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-all duration-500"></div>
                            <div class="absolute inset-0 flex flex-col items-center justify-center p-6 border border-white/0 group-hover:border-white/20 transition-all duration-500 m-4">
                                <h3 class="text-white font-serif text-2xl tracking-widest uppercase mb-2">{{ $category->name }}</h3>
                                <span class="text-royal-gold text-[10px] tracking-[0.5em] uppercase opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-500">View Atelier</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>

            <!-- Featured Products -->
            <section id="featured">
                <div class="flex flex-col items-center mb-16 space-y-4">
                    <h2 class="font-serif text-4xl text-center">The Selection</h2>
                    <div class="w-24 h-px bg-royal-gold"></div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                    @foreach($featuredProducts as $product)
                        <div class="group">
                            <div class="relative aspect-square overflow-hidden bg-stone-100 mb-6 shadow-xl">
                                @php
                                    $featuredImage = isset($product->images[0]) ? $product->images[0] : 'https://via.placeholder.com/800';
                                    $featuredImageUrl = str_starts_with($featuredImage, 'http') ? $featuredImage : asset($featuredImage);
                                @endphp
                                <img src="{{ $featuredImageUrl }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-all duration-700">
                                
                                <div class="absolute inset-0 bg-royal-dark/80 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500">
                                    <a href="{{ route('product.detail', $product->id) }}" class="px-8 py-3 bg-white text-royal-dark text-[10px] font-bold tracking-[0.3em] uppercase hover:bg-royal-gold transition-colors">
                                        Enquire Detail
                                    </a>
                                </div>
                                
                                @if($product->stock_quantity < 3)
                                    <div class="absolute top-4 left-4 bg-royal-gold text-royal-dark text-[8px] font-bold tracking-widest px-3 py-1 uppercase">
                                        Rare Item
                                    </div>
                                @endif
                            </div>
                            
                            <div class="text-center space-y-2">
                                <p class="text-stone-400 text-[10px] tracking-[0.3em] uppercase font-bold">{{ $product->brand }}</p>
                                <h3 class="font-serif text-xl tracking-wide group-hover:text-royal-gold transition-colors">{{ $product->name }}</h3>
                                <p class="text-royal-gold font-light tracking-[0.2em]">₹{{ number_format($product->price, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</div>
