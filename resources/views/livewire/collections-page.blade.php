<div class="animate-fadeIn max-w-7xl mx-auto px-6 py-20">
    <!-- JSON-LD Schema Markup -->
    @if(isset($schema))
        <script type="application/ld+json">
            {!! $schema !!}
        </script>
    @endif

    <!-- Hero Section -->
    <div class="text-center mb-20">
        <p class="text-royal-gold text-[10px] tracking-[0.5em] uppercase font-bold mb-4">Expert Insights</p>
        <h1 class="font-serif text-5xl md:text-7xl gold-text-gradient mb-6">Luxury Watch Collection</h1>
        <div class="w-24 h-px bg-royal-gold mx-auto mb-8"></div>
        <p class="text-stone-600 text-lg max-w-3xl mx-auto">
            Discover expert guides, styling tips, and in-depth reviews of the world's finest timepieces. 
            Your ultimate resource for luxury watch collecting in India.
        </p>
    </div>

    <!-- Featured Articles Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-20">
        <!-- Article 1 -->
        <article class="group bg-white shadow-xl overflow-hidden">
            <div class="aspect-[16/9] overflow-hidden">
                <img 
                    src="https://images.unsplash.com/photo-1523170335258-f5ed11844a49?q=80&w=2080" 
                    alt="How to Choose Your First Luxury Watch - Complete Guide"
                    class="w-full h-full object-cover group-hover:scale-105 transition-all duration-700"
                    loading="lazy"
                >
            </div>
            <div class="p-8 space-y-4">
                <div class="flex items-center space-x-4 text-xs text-stone-500 tracking-wider">
                    <span>GUIDE</span>
                    <span>•</span>
                    <span>10 MIN READ</span>
                </div>
                <h2 class="font-serif text-3xl group-hover:text-royal-gold transition-colors">
                    How to Choose Your First Luxury Watch: A Complete Guide
                </h2>
                <p class="text-stone-600 leading-relaxed">
                    Investing in your first luxury watch is a milestone. Learn about movement types, 
                    brand heritage, complications, and what to look for when buying a premium timepiece in India.
                </p>
                <a href="#article-1" class="inline-block text-royal-gold text-xs font-bold tracking-[0.3em] uppercase hover:underline">
                    Read More →
                </a>
            </div>
        </article>

        <!-- Article 2 -->
        <article class="group bg-white shadow-xl overflow-hidden">
            <div class="aspect-[16/9] overflow-hidden">
                <img 
                    src="https://images.unsplash.com/photo-1524592094714-0f0654e20314?q=80&w=1999" 
                    alt="Top 10 Luxury Watch Brands for Men in India 2026"
                    class="w-full h-full object-cover group-hover:scale-105 transition-all duration-700"
                    loading="lazy"
                >
            </div>
            <div class="p-8 space-y-4">
                <div class="flex items-center space-x-4 text-xs text-stone-500 tracking-wider">
                    <span>REVIEWS</span>
                    <span>•</span>
                    <span>15 MIN READ</span>
                </div>
                <h2 class="font-serif text-3xl group-hover:text-royal-gold transition-colors">
                    Top 10 Luxury Watch Brands for Men in India (2026)
                </h2>
                <p class="text-stone-600 leading-relaxed">
                    From Rolex to Omega, TAG Heuer to Seiko – explore the most prestigious watch brands 
                    available in India, their signature collections, and price ranges.
                </p>
                <a href="#article-2" class="inline-block text-royal-gold text-xs font-bold tracking-[0.3em] uppercase hover:underline">
                    Read More →
                </a>
            </div>
        </article>
    </div>

    <!-- SEO Content Section -->
    <section class="bg-white p-12 shadow-xl mb-20">
        <h2 class="font-serif text-4xl mb-8">Why Choose Royal Collection for Luxury Watches in India?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="space-y-4">
                <div class="text-royal-gold">
                    <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-lg uppercase tracking-wider">Authenticity Guaranteed</h3>
                <p class="text-stone-600">Every timepiece comes with original manufacturer warranty and certificate of authenticity.</p>
            </div>
            <div class="space-y-4">
                <div class="text-royal-gold">
                    <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <h3 class="font-bold text-lg uppercase tracking-wider">Secure Shipping</h3>
                <p class="text-stone-600">Insured delivery across India with premium packaging and real-time tracking.</p>
            </div>
            <div class="space-y-4">
                <div class="text-royal-gold">
                    <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-lg uppercase tracking-wider">Best Prices</h3>
                <p class="text-stone-600">Competitive pricing on luxury watches with flexible EMI options available.</p>
            </div>
        </div>
    </section>

    <!-- Detailed Article Content for SEO -->
    <section id="article-1" class="bg-white p-12 shadow-xl mb-12">
        <h2 class="font-serif text-4xl mb-6">How to Choose Your First Luxury Watch: A Complete Guide</h2>
        <div class="prose max-w-none text-stone-700 space-y-6">
            <p>
                Purchasing your first luxury watch is an exciting milestone. Whether you're looking for a 
                <strong>Rolex Submariner</strong>, an <strong>Omega Speedmaster</strong>, or a 
                <strong>TAG Heuer Carrera</strong>, understanding the fundamentals will help you make an informed decision.
            </p>
            
            <h3 class="font-serif text-2xl mt-8 mb-4">1. Understand Watch Movements</h3>
            <p>
                The movement is the heart of any timepiece. There are three main types:
            </p>
            <ul class="list-disc pl-6 space-y-2">
                <li><strong>Automatic (Self-Winding):</strong> Powered by the natural motion of your wrist. Preferred by collectors for their craftsmanship.</li>
                <li><strong>Manual (Hand-Wound):</strong> Requires daily winding but offers a thinner profile and traditional appeal.</li>
                <li><strong>Quartz:</strong> Battery-powered, highly accurate, and low-maintenance. Ideal for everyday wear.</li>
            </ul>

            <h3 class="font-serif text-2xl mt-8 mb-4">2. Consider Your Lifestyle</h3>
            <p>
                Your daily activities should influence your choice. For business professionals, a classic dress watch 
                like the <strong>Patek Philippe Calatrava</strong> works perfectly. For active individuals, 
                dive watches like the <strong>Rolex Submariner</strong> or <strong>Omega Seamaster</strong> offer durability and water resistance.
            </p>

            <h3 class="font-serif text-2xl mt-8 mb-4">3. Set Your Budget</h3>
            <p>
                Luxury watches in India range from ₹50,000 to several crores. Entry-level luxury brands like 
                <strong>Tissot</strong>, <strong>Hamilton</strong>, and <strong>Longines</strong> offer excellent value. 
                Mid-range options include <strong>TAG Heuer</strong>, <strong>Omega</strong>, and <strong>Breitling</strong>. 
                At the premium end, <strong>Rolex</strong>, <strong>Patek Philippe</strong>, and <strong>Audemars Piguet</strong> 
                represent the pinnacle of horological excellence.
            </p>

            <h3 class="font-serif text-2xl mt-8 mb-4">4. Buy from Authorized Retailers</h3>
            <p>
                Always purchase from authorized dealers like <strong>Royal Collection</strong> to ensure authenticity, 
                manufacturer warranty, and after-sales service. We offer certified pre-owned watches with complete 
                documentation and lifetime warranty on select pieces.
            </p>
        </div>
    </section>

    <section id="article-2" class="bg-white p-12 shadow-xl mb-12">
        <h2 class="font-serif text-4xl mb-6">Top 10 Luxury Watch Brands for Men in India (2026)</h2>
        <div class="prose max-w-none text-stone-700 space-y-6">
            <p>
                India's luxury watch market has grown exponentially, with discerning collectors seeking the finest 
                timepieces from Swiss and Japanese manufacturers. Here are the top 10 luxury watch brands you should 
                know about in 2026:
            </p>

            <div class="space-y-8">
                <div>
                    <h3 class="font-serif text-2xl mb-2">1. Rolex</h3>
                    <p>The crown jewel of luxury watches. Iconic models include Submariner, Datejust, and Daytona. Price range: ₹5,00,000 - ₹50,00,000+</p>
                </div>
                
                <div>
                    <h3 class="font-serif text-2xl mb-2">2. Omega</h3>
                    <p>Official timekeeper of the Olympics. Famous for Speedmaster (Moonwatch) and Seamaster collections. Price range: ₹2,50,000 - ₹15,00,000</p>
                </div>

                <div>
                    <h3 class="font-serif text-2xl mb-2">3. TAG Heuer</h3>
                    <p>Synonymous with motorsport and precision. Popular models: Carrera, Monaco, Aquaracer. Price range: ₹1,00,000 - ₹5,00,000</p>
                </div>

                <div>
                    <h3 class="font-serif text-2xl mb-2">4. Patek Philippe</h3>
                    <p>The ultimate status symbol. Nautilus and Calatrava are highly sought after. Price range: ₹20,00,000 - ₹1,00,00,000+</p>
                </div>

                <div>
                    <h3 class="font-serif text-2xl mb-2">5. Audemars Piguet</h3>
                    <p>Royal Oak is one of the most recognizable luxury sports watches. Price range: ₹25,00,000 - ₹80,00,000+</p>
                </div>
            </div>

            <p class="mt-8">
                <strong>Shop all these luxury watch brands at Royal Collection</strong> with guaranteed authenticity, 
                manufacturer warranty, and secure shipping across India. Visit our collection or contact our 
                watch experts for personalized recommendations.
            </p>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="text-center royal-gradient text-white p-16">
        <h2 class="font-serif text-4xl mb-6">Ready to Find Your Perfect Timepiece?</h2>
        <p class="text-stone-300 mb-8 text-lg">Explore our curated collection of luxury watches</p>
        <a href="{{ route('home') }}" class="inline-block px-12 py-5 border-2 border-royal-gold text-royal-gold hover:bg-royal-gold hover:text-royal-dark transition-all duration-500 text-xs font-bold tracking-[0.4em] uppercase">
            Browse Collection
        </a>
    </section>
</div>
