<div class="min-h-screen bg-gradient-to-br from-royal-dark via-stone-900 to-royal-dark py-20 px-6">
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="font-serif text-4xl gold-text-gradient uppercase tracking-widest font-bold mb-3">Personal Archives</h1>
            <p class="text-stone-400 text-sm tracking-wider italic">Curate your distinguished profile</p>
        </div>

        <!-- Success Message -->
        @if(session()->has('success'))
            <div class="bg-royal-gold/10 border border-royal-gold text-royal-gold px-6 py-4 rounded-sm mb-8 text-center text-sm tracking-wider">
                {{ session('success') }}
            </div>
        @endif

        <!-- Profile Form -->
        <form wire:submit.prevent="saveProfile" class="bg-stone-900/50 backdrop-blur-sm border border-white/10 rounded-sm p-10 shadow-2xl">
            
            <!-- Name Field -->
            <div class="mb-8">
                <label class="block text-xs font-bold tracking-[0.3em] uppercase text-stone-400 mb-3">Full Name <span class="text-royal-gold">*</span></label>
                <input 
                    type="text" 
                    wire:model="name" 
                    class="w-full bg-royal-dark border border-white/20 rounded-sm px-6 py-4 text-white focus:border-royal-gold focus:ring-2 focus:ring-royal-gold/20 transition-all text-sm tracking-wider"
                    placeholder="Enter your distinguished name"
                    required
                >
                @error('name') <span class="text-red-400 text-xs mt-2 block">{{ $message }}</span> @enderror
            </div>

            <!-- Date of Birth Field -->
            <div class="mb-8">
                <label class="block text-xs font-bold tracking-[0.3em] uppercase text-stone-400 mb-3">Date of Birth</label>
                <input 
                    type="date" 
                    wire:model="dob" 
                    class="w-full bg-royal-dark border border-white/20 rounded-sm px-6 py-4 text-white focus:border-royal-gold focus:ring-2 focus:ring-royal-gold/20 transition-all text-sm tracking-wider"
                >
                @error('dob') <span class="text-red-400 text-xs mt-2 block">{{ $message }}</span> @enderror
            </div>

            <!-- Mobile Number Field (Read-only) -->
            <div class="mb-8">
                <label class="block text-xs font-bold tracking-[0.3em] uppercase text-stone-400 mb-3">Mobile Number</label>
                <input 
                    type="text" 
                    wire:model="mobile_number" 
                    class="w-full bg-stone-800/50 border border-white/10 rounded-sm px-6 py-4 text-stone-500 cursor-not-allowed text-sm tracking-wider"
                    readonly
                >
                <p class="text-stone-600 text-xs mt-2 italic">This field is linked to your account and cannot be modified.</p>
            </div>

            <!-- Address Field -->
            <div class="mb-10">
                <label class="block text-xs font-bold tracking-[0.3em] uppercase text-stone-400 mb-3">Address</label>
                <textarea 
                    wire:model="address" 
                    rows="4"
                    class="w-full bg-royal-dark border border-white/20 rounded-sm px-6 py-4 text-white focus:border-royal-gold focus:ring-2 focus:ring-royal-gold/20 transition-all text-sm tracking-wider resize-none"
                    placeholder="Enter your residential address"
                ></textarea>
                @error('address') <span class="text-red-400 text-xs mt-2 block">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center">
                <button 
                    type="submit"
                    class="px-12 py-4 bg-royal-gold text-royal-dark text-xs font-bold tracking-[0.3em] uppercase rounded-sm hover:bg-opacity-90 transition-all shadow-2xl hover:shadow-royal-gold/30 hover:scale-105 transform"
                >
                    Save Profile
                </button>
            </div>

        </form>

        <!-- Back to Dashboard -->
        <div class="text-center mt-10">
            <a href="{{ route('home') }}" class="text-stone-500 hover:text-royal-gold text-xs tracking-widest uppercase transition-colors">
                ← Return to Collezione
            </a>
        </div>
    </div>
</div>
