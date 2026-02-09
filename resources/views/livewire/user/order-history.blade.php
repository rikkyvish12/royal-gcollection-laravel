<div class="animate-fadeIn max-w-7xl mx-auto px-6 py-20">
    <div class="flex flex-col items-center mb-16 space-y-4">
        <h2 class="font-serif text-4xl text-center uppercase tracking-widest">Order Archives</h2>
        <div class="w-24 h-px bg-royal-gold"></div>
    </div>

    @if($orders->count() > 0)
        <div class="space-y-12">
            @foreach($orders as $order)
                <div class="bg-white shadow-2xl border border-stone-100 overflow-hidden">
                    <div class="bg-royal-dark text-white px-8 py-6 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                        <div class="flex space-x-12">
                            <div>
                                <p class="text-[9px] font-bold tracking-[0.3em] uppercase text-stone-400">Order Ref</p>
                                <p class="font-serif text-lg tracking-widest uppercase">RC-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                            </div>
                            <div>
                                <p class="text-[9px] font-bold tracking-[0.3em] uppercase text-stone-400">Date</p>
                                <p class="text-sm font-light tracking-widest uppercase">{{ $order->created_at->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-[9px] font-bold tracking-[0.3em] uppercase text-stone-400">Total</p>
                                <p class="text-sm font-bold tracking-widest uppercase text-royal-gold">₹{{ number_format($order->total_amount, 2) }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-4">
                            <span class="px-4 py-1.5 border border-royal-gold/30 text-[10px] font-bold tracking-[0.2em] uppercase rounded-full">
                                {{ $order->status }}
                            </span>
                            @if($order->tracking_number)
                                <span class="text-[9px] font-bold tracking-[0.2em] uppercase text-stone-400">
                                    Track: {{ $order->tracking_number }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="p-8">
                        <div class="space-y-6">
                            @foreach($order->orderItems as $item)
                                <div class="flex items-center justify-between border-b border-stone-50 pb-6 last:border-0 last:pb-0">
                                    <div class="flex items-center space-x-6">
                                        <img src="{{ isset($item->product->images[0]) ? $item->product->images[0] : 'https://via.placeholder.com/100' }}" 
                                             class="w-20 h-20 object-cover grayscale transition-all duration-500 hover:grayscale-0">
                                        <div>
                                            <h4 class="font-serif text-lg tracking-wide uppercase">{{ $item->product->name }}</h4>
                                            <p class="text-[10px] font-bold tracking-[0.3em] uppercase text-stone-400">{{ $item->product->brand }}</p>
                                            <p class="text-xs font-light text-stone-500 mt-1">Qty: {{ $item->quantity }}</p>
                                        </div>
                                    </div>
                                    <p class="font-serif text-lg tracking-widest">₹{{ number_format($item->price, 2) }}</p>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-10 pt-8 border-t border-stone-100 grid grid-cols-1 md:grid-cols-2 gap-12">
                            <div>
                                <h5 class="text-[10px] font-bold tracking-[0.3em] uppercase text-stone-500 mb-4">Shipping Destination</h5>
                                <p class="text-sm text-stone-600 font-light leading-relaxed uppercase tracking-widest">
                                    {{ $order->shipping_address }}
                                </p>
                            </div>
                            <div class="flex flex-col justify-center items-end">
                                <p class="text-[10px] font-bold tracking-[0.3em] uppercase text-stone-500 mb-2">Payment</p>
                                <p class="text-sm font-light tracking-widest uppercase">
                                    {{ $order->payment_method }} - <span class="text-royal-gold font-bold">{{ $order->payment_status }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-40 bg-white shadow-xl flex flex-col items-center space-y-8">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-stone-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            <p class="font-serif text-2xl text-stone-400 italic">No acquisitions found in your archives.</p>
            <a href="{{ route('home') }}" class="px-12 py-4 border border-royal-dark text-royal-dark text-[10px] font-bold tracking-[0.3em] uppercase hover:bg-royal-dark hover:text-white transition-all uppercase">Begin Discovery</a>
        </div>
    @endif
</div>
