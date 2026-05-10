<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- SEO Meta Tags -->
        <title>{{ $title ?? 'Royal Collection | Luxury Watches in India - Premium Timepieces' }}</title>
        <meta name="description" content="{{ $metaDescription ?? 'Discover exclusive luxury watches at Royal Collection. Shop premium timepieces from top brands with lifetime warranty and secure shipping across India.' }}">
        <meta name="keywords" content="{{ $metaKeywords ?? 'luxury watches, premium watches, designer watches, watch collection, India' }}">
        <meta name="robots" content="index, follow">
        <link rel="canonical" href="{{ $canonicalUrl ?? url()->current() }}">
        
        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="{{ $ogType ?? 'website' }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:title" content="{{ $ogTitle ?? 'Royal Collection | Luxury Watches in India' }}">
        <meta property="og:description" content="{{ $ogDescription ?? $metaDescription ?? 'Discover exclusive luxury watches at Royal Collection. Shop premium timepieces from top brands.' }}">
        <meta property="og:image" content="{{ $ogImage ?? asset('https://images.unsplash.com/photo-1614164185128-e4ec99c436d7?q=80&w=2070') }}">
        
        <!-- Twitter -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:url" content="{{ url()->current() }}">
        <meta name="twitter:title" content="{{ $ogTitle ?? 'Royal Collection | Luxury Watches in India' }}">
        <meta name="twitter:description" content="{{ $ogDescription ?? $metaDescription ?? 'Discover exclusive luxury watches at Royal Collection.' }}">
        <meta name="twitter:image" content="{{ $ogImage ?? asset('https://images.unsplash.com/photo-1614164185128-e4ec99c436d7?q=80&w=2070') }}">
        
        <!-- Premium Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
        
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            'royal-gold': '#D4AF37',
                            'royal-dark': '#1A1A1A',
                        },
                        fontFamily: {
                            'serif': ['Playfair Display', 'serif'],
                            'sans': ['Inter', 'sans-serif'],
                        }
                    }
                }
            }
        </script>
        <style>
            [x-cloak] { display: none !important; }
            .royal-gradient { background: linear-gradient(135deg, #1A1A1A 0%, #333333 100%); }
            .gold-text-gradient {
                background: linear-gradient(to right, #BF953F, #FCF6BA, #B38728, #FBF5B7, #AA771C);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
        </style>
        @livewireStyles
    </head>
    <body class="bg-stone-50 font-sans text-royal-dark antialiased" x-data="{ showSearchModal: false, searchQuery: '' }">
        <nav x-data="{ mobileMenuOpen: false }" class="bg-white text-royal-dark sticky top-0 z-50 shadow-md border-b border-stone-200">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex justify-between items-center h-16">
                    <!-- Left: Logo -->
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                        <!-- Crown Icon -->
                        <svg class="h-8 w-8 text-royal-gold group-hover:scale-110 transition-transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" />
                        </svg>
                        <!-- Text Logo -->
                        <div class="flex flex-col">
                            <span class="font-serif text-lg font-bold uppercase tracking-widest text-royal-dark leading-none group-hover:text-royal-gold transition-colors">Royal</span>
                            <span class="text-[9px] uppercase tracking-[0.3em] text-stone-500 font-medium">Collection</span>
                        </div>
                    </a>

                    <!-- Center: Main Navigation -->
                    <div class="hidden md:flex items-center space-x-8 text-sm font-medium tracking-wider uppercase">
                        <a href="{{ route('home') }}" class="text-royal-dark hover:text-royal-gold transition-colors py-5 border-b-2 border-transparent hover:border-royal-gold">All Watches</a>
                        <a href="{{ route('super-category', 'men') }}" class="text-royal-dark hover:text-royal-gold transition-colors py-5 border-b-2 border-transparent hover:border-royal-gold">Men</a>
                        <a href="{{ route('super-category', 'women') }}" class="text-royal-dark hover:text-royal-gold transition-colors py-5 border-b-2 border-transparent hover:border-royal-gold">Women</a>
                        <a href="{{ route('super-category', 'smart-watches') }}" class="text-royal-dark hover:text-royal-gold transition-colors py-5 border-b-2 border-transparent hover:border-royal-gold">Smart</a>
                        <a href="{{ route('brands') }}" class="text-royal-dark hover:text-royal-gold transition-colors py-5 border-b-2 border-transparent hover:border-royal-gold">Brands</a>
                        <a href="{{ route('collections') }}" class="text-royal-gold hover:text-royal-dark transition-colors py-5 border-b-2 border-transparent hover:border-royal-dark font-bold">Collection</a>
                    </div>

                    <!-- Right: Search, Wishlist, Profile, Cart -->
                    <div class="flex items-center space-x-6">
                        <!-- Search Bar -->
                        <form action="{{ route('home') }}" method="GET" class="hidden md:flex items-center">
                            <div class="relative">
                                <input 
                                    type="text" 
                                    name="search" 
                                    placeholder="Search entire store..." 
                                    class="bg-stone-100 border-none rounded-full pl-4 pr-10 py-2 text-sm w-64 focus:ring-2 focus:ring-royal-gold focus:outline-none placeholder-stone-500 text-royal-dark"
                                    value="{{ request()->get('search') }}"
                                >
                                <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-stone-500 hover:text-royal-gold transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </button>
                            </div>
                        </form>

                        <!-- Wishlist Icon -->
                        <a href="#" class="hidden md:block p-2 hover:bg-stone-100 rounded-full transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-royal-dark hover:text-royal-gold transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </a>

                        <!-- Profile Icon -->
                        @auth
                            <a href="{{ route('profile') }}" class="hidden md:block p-2 hover:bg-stone-100 rounded-full transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-royal-dark hover:text-royal-gold transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="hidden md:block p-2 hover:bg-stone-100 rounded-full transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-royal-dark hover:text-royal-gold transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </a>
                        @endauth

                        <!-- Cart Icon with Badge -->
                        <a href="{{ route('cart') }}" class="relative p-2 hover:bg-stone-100 rounded-full transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-royal-dark hover:text-royal-gold transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            @php $cartCount = count(session()->get('cart', [])); @endphp
                            @if($cartCount > 0)
                                <span class="absolute -top-1 -right-1 bg-royal-gold text-white text-[10px] font-bold h-5 w-5 flex items-center justify-center rounded-full shadow-lg">{{ $cartCount }}</span>
                            @endif
                        </a>

                        <!-- Logout Icon (Only for Authenticated Users) -->
                        @auth
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="hidden md:block p-2 hover:bg-stone-100 rounded-full transition-all" title="Logout">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-royal-dark hover:text-red-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                </button>
                            </form>
                        @endauth

                        <!-- Mobile Search Button (Visible only on mobile) -->
                        <button 
                            @click="showSearchModal = true"
                            class="md:hidden p-2 text-royal-dark focus:outline-none"
                            aria-label="Search"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                        

                    </div>
                </div>
            </div>


            <!-- Mobile Search Modal -->
            <div 
                x-show="showSearchModal"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="fixed inset-0 z-50 overflow-y-auto"
                style="display: none;"
            >
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity" @click="showSearchModal = false">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>
                    
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
                    
                    <div 
                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                        @click.away="showSearchModal = false"
                        x-show="showSearchModal"
                    >
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="w-full mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                    <h3 class="text-lg leading-6 font-medium text-royal-dark mb-4">
                                        Search Products & Categories
                                    </h3>
                                    <form action="{{ route('home') }}" method="GET">
                                        <div class="mt-2">
                                            <input 
                                                type="text" 
                                                name="search" 
                                                placeholder="Search entire store..." 
                                                class="w-full px-4 py-3 border border-stone-200 rounded-lg focus:ring-2 focus:ring-royal-gold focus:border-transparent text-base"
                                                x-model="searchQuery"
                                                autofocus
                                            >
                                            <div class="mt-4 flex space-x-3">
                                                <button 
                                                    type="submit"
                                                    class="flex-1 px-4 py-3 bg-royal-gold text-royal-dark text-sm font-bold tracking-wider uppercase rounded-lg hover:bg-opacity-90 transition-all"
                                                >
                                                    Search
                                                </button>
                                                <button 
                                                    type="button" 
                                                    @click="showSearchModal = false" 
                                                    class="flex-1 px-4 py-3 border border-stone-200 text-stone-500 text-sm font-bold tracking-wider uppercase rounded-lg hover:bg-stone-50 transition-all"
                                                >
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dropdown Menu for Authenticated Users (hidden by default, shown on profile hover) -->
            @auth
                <div class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-xl py-2 z-50" id="profile-dropdown">
                    <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-royal-dark hover:bg-stone-100">My Profile</a>
                    <a href="{{ route('order.history') }}" class="block px-4 py-2 text-sm text-royal-dark hover:bg-stone-100">Order History</a>
                    @if(auth()->user()->is_admin)
                        <a href="/admin" class="block px-4 py-2 text-sm text-royal-dark hover:bg-stone-100">Admin Panel</a>
                    @endif
                    <hr class="my-2 border-stone-200">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-stone-100">
                            Logout
                        </button>
                    </form>
                </div>
            @endauth
        </nav>

        <main class="pb-16 md:pb-0">
            {{ $slot ?? '' }}
            @yield('content')
        </main>

        <footer class="bg-royal-dark text-stone-400 py-20 mt-20 border-t border-royal-gold/20">
            <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-12">
                <div class="col-span-1 md:col-span-1">
                    <span class="font-serif text-xl gold-text-gradient font-bold uppercase tracking-widest mb-6 block">Royal Collection</span>
                    <p class="text-sm leading-relaxed italic font-serif">Crafting timeless elegance for the distinguished few since 1982.</p>
                </div>
                <div>
                    <h4 class="text-white text-xs font-bold uppercase tracking-[0.3em] mb-6">Timeless Wisdom</h4>
                    <div class="space-y-6">
                        <blockquote class="border-l-2 border-royal-gold pl-4 italic text-sm text-stone-300">
                            "A man's watch is the jewelry of his soul."
                            <cite class="block text-[10px] mt-2 text-stone-500 not-italic">— Coco Chanel</cite>
                        </blockquote>
                        <blockquote class="border-l-2 border-royal-gold pl-4 italic text-sm text-stone-300">
                            "Time is what we want most, but what we use worst."
                            <cite class="block text-[10px] mt-2 text-stone-500 not-italic">— William Penn</cite>
                        </blockquote>
                        <blockquote class="border-l-2 border-royal-gold pl-4 italic text-sm text-stone-300">
                            "The hourglass reminds us that every moment is precious."
                            <cite class="block text-[10px] mt-2 text-stone-500 not-italic">— Royal Collection</cite>
                        </blockquote>
                    </div>
                </div>
                <div>
                    <h4 class="text-white text-xs font-bold uppercase tracking-[0.3em] mb-6">Legal</h4>
                    <ul class="space-y-4 text-xs tracking-widest">
                        <li><a href="{{ route('privacy.policy') }}" class="hover:text-royal-gold transition-colors">Privacy Policy</a></li>
                        <li><a href="{{ route('terms.conditions') }}" class="hover:text-royal-gold transition-colors">Terms & Conditions</a></li>
                        <li><a href="{{ route('cookie.policy') }}" class="hover:text-royal-gold transition-colors">Cookie Policy</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white text-xs font-bold uppercase tracking-[0.3em] mb-6">Newsletter</h4>
                    <p class="text-xs mb-4 tracking-wider">Join the inner circle for exclusive previews.</p>
                    <div class="flex border-b border-royal-gold/50 py-2">
                        <input type="email" placeholder="YOUR EMAIL" class="bg-transparent border-none text-xs w-full focus:ring-0 placeholder-stone-600">
                        <button class="text-royal-gold text-xs font-bold tracking-widest uppercase">Join</button>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto px-6 mt-20 pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center text-[10px] tracking-[0.4em] uppercase">
                <p>&copy; 2026 ROYAL COLLECTION. ALL RIGHTS RESERVED.</p>
                <div class="flex space-x-8 mt-4 md:mt-0">
                    <span>IG</span><span>TW</span><span>FB</span>
                </div>
            </div>
        </footer>

        <!-- Bottom Navigation for Mobile -->
        <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-stone-200 shadow-lg z-50 md:hidden">
            <div class="flex justify-around items-center py-3">
                <a href="{{ route('home') }}" class="flex flex-col items-center text-royal-dark hover:text-royal-gold transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="text-[10px] mt-1 uppercase tracking-wider">Home</span>
                </a>
                
                <button @click="showSearchModal = true" class="flex flex-col items-center text-royal-dark hover:text-royal-gold transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <span class="text-[10px] mt-1 uppercase tracking-wider">Search</span>
                </button>
                
                @auth
                    <a href="{{ route('profile') }}" class="flex flex-col items-center text-royal-dark hover:text-royal-gold transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="text-[10px] mt-1 uppercase tracking-wider">Profile</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="flex flex-col items-center text-royal-dark hover:text-royal-gold transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="text-[10px] mt-1 uppercase tracking-wider">Profile</span>
                    </a>
                @endauth
                
                <a href="{{ route('cart') }}" class="flex flex-col items-center text-royal-dark hover:text-royal-gold transition-colors relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    @php $cartCount = count(session()->get('cart', [])); @endphp
                    @if($cartCount > 0)
                        <span class="absolute -top-2 -right-2 bg-royal-gold text-white text-[10px] font-bold h-5 w-5 flex items-center justify-center rounded-full">{{ $cartCount }}</span>
                    @endif
                    <span class="text-[10px] mt-1 uppercase tracking-wider">Cart</span>
                </a>
                
                @auth
                    <a href="{{ route('order.history') }}" class="flex flex-col items-center text-royal-dark hover:text-royal-gold transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 002 2h2a2 2 0 002-2" />
                        </svg>
                        <span class="text-[10px] mt-1 uppercase tracking-wider">Orders</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="flex flex-col items-center text-royal-dark hover:text-royal-gold transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 002 2h2a2 2 0 002-2" />
                        </svg>
                        <span class="text-[10px] mt-1 uppercase tracking-wider">Orders</span>
                    </a>
                @endauth
            </div>
        </div>

        <!-- Alpine.js is included with Livewire, no separate import needed -->
        
        @livewireScripts
        <script>
            // Livewire is now properly configured
            document.addEventListener('DOMContentLoaded', function() {
                if (window.Livewire) {
                    console.log('Livewire loaded successfully');
                }
            });
        </script>
    </body>
</html>
