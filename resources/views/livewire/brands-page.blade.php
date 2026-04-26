<div class="min-h-screen bg-stone-50">
    <!-- Page Header -->
    <div class="bg-white border-b border-stone-200 py-12">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="font-serif text-4xl font-bold text-royal-dark uppercase tracking-wider">Shop by Brands</h1>
            <p class="text-stone-600 mt-2 text-sm">Discover luxury timepieces from the world's finest watchmakers</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-10">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Sidebar Filters -->
            <aside class="lg:w-1/4 w-full">
                <div class="bg-white rounded-sm border border-stone-200 sticky top-20">
                    
                    <!-- Filter Header -->
                    <div class="p-6 border-b border-stone-200 flex justify-between items-center">
                        <h2 class="font-bold text-lg uppercase tracking-wider text-royal-dark">Filters</h2>
                        @if(!empty($selectedBrands) || $minPrice > 0 || $maxPrice < 1000000)
                            <button wire:click="clearFilters" class="text-xs text-royal-gold hover:text-royal-dark uppercase tracking-wider font-semibold">
                                Clear All
                            </button>
                        @endif
                    </div>

                    <!-- Brand Filter -->
                    <div class="p-6 border-b border-stone-200">
                        <h3 class="font-bold text-sm uppercase tracking-wider text-royal-dark mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            Brands
                        </h3>
                        <div class="space-y-3 max-h-96 overflow-y-auto pr-2">
                            @foreach($allBrands as $brand)
                                <label class="flex items-center cursor-pointer group hover:bg-stone-50 p-2 rounded transition-colors">
                                    <input 
                                        type="checkbox" 
                                        wire:click="toggleBrand('{{ $brand }}')"
                                        @if(in_array($brand, $selectedBrands)) checked @endif
                                        class="w-4 h-4 text-royal-gold border-stone-300 rounded focus:ring-royal-gold focus:ring-2"
                                    >
                                    <span class="ml-3 text-sm text-royal-dark group-hover:text-royal-gold transition-colors uppercase tracking-wide">
                                        {{ $brand }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Price Range Filter -->
                    <div class="p-6">
                        <h3 class="font-bold text-sm uppercase tracking-wider text-royal-dark mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Price Range
                        </h3>
                        
                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="text-xs text-stone-600 uppercase tracking-wider">Min</label>
                                    <input 
                                        type="number" 
                                        wire:model="priceRange.0"
                                        class="w-full mt-1 px-3 py-2 border border-stone-300 rounded-sm text-sm focus:ring-2 focus:ring-royal-gold focus:border-royal-gold"
                                        placeholder="₹0"
                                    >
                                </div>
                                <div>
                                    <label class="text-xs text-stone-600 uppercase tracking-wider">Max</label>
                                    <input 
                                        type="number" 
                                        wire:model="priceRange.1"
                                        class="w-full mt-1 px-3 py-2 border border-stone-300 rounded-sm text-sm focus:ring-2 focus:ring-royal-gold focus:border-royal-gold"
                                        placeholder="₹1000000"
                                    >
                                </div>
                            </div>
                            <button 
                                wire:click="applyPriceFilter"
                                class="w-full py-2 bg-royal-gold text-white text-xs font-bold uppercase tracking-wider rounded-sm hover:bg-opacity-90 transition-all"
                            >
                                Apply Filter
                            </button>
                        </div>
                    </div>

                </div>
            </aside>

            <!-- Products Grid -->
            <main class="lg:w-3/4 w-full">
                
                <!-- Active Filters Display -->
                @if(!empty($selectedBrands) || $minPrice > 0 || $maxPrice < 1000000)
                    <div class="mb-6 p-4 bg-white rounded-sm border border-stone-200">
                        <div class="flex flex-wrap gap-2 items-center">
                            <span class="text-xs text-stone-600 uppercase tracking-wider font-semibold">Active Filters:</span>
                            
                            @foreach($selectedBrands as $brand)
                                <span class="inline-flex items-center gap-2 px-3 py-1 bg-royal-gold/10 text-royal-dark text-xs rounded-full border border-royal-gold/30">
                                    {{ $brand }}
                                    <button wire:click="toggleBrand('{{ $brand }}')" class="hover:text-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </span>
                            @endforeach

                            @if($minPrice > 0 || $maxPrice < 1000000)
                                <span class="inline-flex items-center gap-2 px-3 py-1 bg-royal-gold/10 text-royal-dark text-xs rounded-full border border-royal-gold/30">
                                    ₹{{ number_format($minPrice) }} - ₹{{ number_format($maxPrice) }}
                                </span>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Products Count -->
                <div class="mb-6 flex justify-between items-center">
                    <p class="text-sm text-stone-600">
                        <span class="font-bold text-royal-dark">{{ $products->total() }}</span> products found
                    </p>
                </div>

                <!-- Products Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($products as $product)
                        <a href="{{ route('product.detail', $product->id) }}" class="group bg-white rounded-sm border border-stone-200 overflow-hidden hover:shadow-xl transition-all duration-300">
                            <!-- Product Image -->
                             <div class="aspect-square bg-stone-100 relative overflow-hidden">
                                @php
                                    $productImage = ($product->images && count($product->images) > 0) ? $product->images[0] : null;
                                    $productImageUrl = $productImage ? (str_starts_with($productImage, 'http') ? $productImage : asset($productImage)) : null;
                                @endphp
                                @if($productImageUrl)
                                    <img src="{{ $productImageUrl }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-stone-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                
                                <!-- Brand Badge -->
                                <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-sm">
                                    <span class="text-[10px] font-bold uppercase tracking-widest text-royal-dark">{{ $product->brand }}</span>
                                </div>
                            </div>

                            <!-- Product Info -->
                            <div class="p-4">
                                <h3 class="font-serif text-lg font-bold text-royal-dark mb-2 group-hover:text-royal-gold transition-colors line-clamp-1">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-sm text-stone-600 mb-3 line-clamp-2">{{ $product->description }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-xl font-bold text-royal-gold">₹{{ number_format($product->price) }}</span>
                                    @if($product->stock_quantity > 0)
                                        <span class="text-xs text-green-600 font-semibold">In Stock</span>
                                    @else
                                        <span class="text-xs text-red-600 font-semibold">Out of Stock</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full text-center py-20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 mx-auto text-stone-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-stone-600 text-lg mb-2">No products found</p>
                            <p class="text-stone-500 text-sm">Try adjusting your filters</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-10">
                    {{ $products->links() }}
                </div>

            </main>

        </div>
    </div>
</div>
