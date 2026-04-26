<div class="animate-fadeIn max-w-md mx-auto py-24 px-6">
    <div class="bg-white p-10 shadow-2xl space-y-10 border-t-4 border-royal-gold">
        <div class="text-center space-y-2">
            <h2 class="font-serif text-3xl gold-text-gradient uppercase tracking-widest font-bold">Private Room</h2>
            <p class="text-stone-400 text-[10px] tracking-[0.3em] uppercase">Access the inner circle</p>
        </div>

        @if(session()->has('otp_debug'))
            <div class="bg-stone-100 p-4 text-[10px] font-mono text-stone-500 break-all">
                {{ session('otp_debug') }}
            </div>
        @endif
        
        @if(session()->has('dev_otp'))
            <div class="bg-yellow-100 border border-yellow-300 p-4 text-[10px] font-mono text-yellow-800 break-all">
                {{ session('dev_otp') }}
            </div>
        @endif

        <div class="space-y-8">
            @if(!$showOtpInput)
                <div class="space-y-4">
                    <label class="text-[10px] font-bold tracking-[0.3em] uppercase text-stone-500">Mobile Number</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-stone-400 text-xs">+91</span>
                        <input type="text" wire:model="mobile_number" placeholder="9876543210" 
                               class="w-full pl-12 pr-4 py-4 bg-stone-50 border border-stone-200 focus:border-royal-gold focus:ring-0 transition-all text-sm tracking-widest">
                    </div>
                    @error('mobile_number') <p class="text-red-500 text-[10px] uppercase tracking-widest">{{ $message }}</p> @enderror
                    
                    <button wire:click="sendOtp" 
                            wire:loading.attr="disabled"
                            wire:loading.class="opacity-50 cursor-not-allowed"
                            type="button"
                            class="w-full py-5 bg-royal-dark text-white text-[10px] font-bold tracking-[0.4em] uppercase hover:bg-royal-gold hover:text-royal-dark transition-all duration-500 shadow-xl relative">
                        <span wire:loading.remove>Send OTP via WhatsApp</span>
                        <span wire:loading class="flex items-center justify-center">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Sending...
                        </span>
                    </button>
                </div>
            @else
                <div class="space-y-4">
                    <label class="text-[10px] font-bold tracking-[0.3em] uppercase text-stone-500 text-center block">Enter verification code</label>
                    <input type="text" wire:model="otp" placeholder="000000" 
                           class="w-full px-4 py-4 bg-stone-50 border border-stone-200 focus:border-royal-gold focus:ring-0 transition-all text-center text-2xl tracking-[0.5em] font-light">
                    @error('otp') <p class="text-red-500 text-[10px] uppercase tracking-widest text-center">{{ $message }}</p> @enderror
                    
                    <button wire:click="verifyOtp" 
                            @click="console.log('Verify OTP button clicked')"
                            wire:loading.attr="disabled"
                            wire:loading.class="opacity-50 cursor-not-allowed"
                            type="button"
                            class="w-full py-5 bg-royal-dark text-white text-[10px] font-bold tracking-[0.4em] uppercase hover:bg-royal-gold hover:text-royal-dark transition-all duration-500 shadow-xl relative">
                        <span wire:loading.remove>Verify & Enter</span>
                        <span wire:loading class="flex items-center justify-center">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Verifying...
                        </span>
                    </button>
                    
                    <button wire:click="$set('showOtpInput', false)" class="w-full text-[9px] tracking-widest uppercase text-stone-400 hover:text-royal-dark transition-colors">
                        Change Number
                    </button>
                </div>
            @endif

            <div class="relative py-4">
                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-stone-100"></div></div>
                <div class="relative flex justify-center text-[9px] uppercase tracking-[0.3em] font-bold"><span class="bg-white px-4 text-stone-400">Or Continue With</span></div>
            </div>

            <a href="/auth/google" class="w-full flex items-center justify-center space-x-4 py-4 border border-stone-200 hover:bg-stone-50 transition-all group">
                <svg class="h-5 w-5" viewBox="0 0 24 24"><path fill="currentColor" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.18 1-.76 1.85-1.61 2.42v2.01h2.61c1.52-1.41 2.4-3.48 2.4-5.44z"/><path fill="currentColor" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-2.61-2.01c-.72.48-1.65.76-2.67.76-2.86 0-5.29-1.93-6.16-4.53H2.18v2.07C3.99 20.19 7.74 23 12 23z"/><path fill="currentColor" d="M5.84 14.56c-.22-.66-.35-1.36-.35-2.06s.13-1.4.35-2.06V8.37H2.18C1.43 9.83 1 11.46 1 13.12s.43 3.29 1.18 4.75l3.66-2.81z"/><path fill="currentColor" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.74 1 3.99 3.81 2.18 8.37l3.66 2.81c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>
                <span class="text-[10px] font-bold tracking-[0.2em] uppercase text-stone-600 group-hover:text-royal-dark transition-colors">Google Account</span>
            </a>
        </div>
    </div>
</div>
