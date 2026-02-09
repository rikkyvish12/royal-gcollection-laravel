<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Royal Collection | Luxury Watches' }}</title>
        
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
    <body class="bg-stone-50 font-sans text-royal-dark antialiased">
        <nav class="bg-white text-royal-dark sticky top-0 z-50 shadow-md border-b border-stone-200">
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
                    </div>

                    <!-- Right: Search, Wishlist, Profile, Cart -->
                    <div class="flex items-center space-x-6">
                        <!-- Search Bar -->
                        <div class="hidden md:flex items-center bg-stone-100 rounded-full px-4 py-2 w-64">
                            <input 
                                type="text" 
                                placeholder="Search entire store..." 
                                class="bg-transparent border-none text-sm w-full focus:ring-0 focus:outline-none placeholder-stone-500 text-royal-dark"
                            >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-stone-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>

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

                        <!-- Mobile Menu Button -->
                        <button class="md:hidden p-2 text-royal-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                            </svg>
                        </button>
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

        <main>
            {{ $slot }}
        </main>

        <footer class="bg-royal-dark text-stone-400 py-20 mt-20 border-t border-royal-gold/20">
            <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-12">
                <div class="col-span-1 md:col-span-1">
                    <span class="font-serif text-xl gold-text-gradient font-bold uppercase tracking-widest mb-6 block">Royal Collection</span>
                    <p class="text-sm leading-relaxed italic font-serif">Crafting timeless elegance for the distinguished few since 1982.</p>
                </div>
                <div>
                    <h4 class="text-white text-xs font-bold uppercase tracking-[0.3em] mb-6">Experience</h4>
                    <ul class="space-y-4 text-xs tracking-widest">
                        <li><a href="#" class="hover:text-royal-gold transition-colors">Virtual Concierge</a></li>
                        <li><a href="#" class="hover:text-royal-gold transition-colors">Private Viewing</a></li>
                        <li><a href="#" class="hover:text-royal-gold transition-colors">Bespoke Fitting</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white text-xs font-bold uppercase tracking-[0.3em] mb-6">Legal</h4>
                    <ul class="space-y-4 text-xs tracking-widest">
                        <li><a href="#" class="hover:text-royal-gold transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-royal-gold transition-colors">Terms of Haute Service</a></li>
                        <li><a href="#" class="hover:text-royal-gold transition-colors">Cookie Concierge</a></li>
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

        @livewireScripts
    </body>
</html>
