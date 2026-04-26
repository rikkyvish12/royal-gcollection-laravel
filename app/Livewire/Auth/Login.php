<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Models\WhatsappOtp;
use App\Services\WhatsAppService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $mobile_number;
    public $otp;
    public $showOtpInput = false;

    protected $rules = [
        'mobile_number' => 'required|numeric|digits:10',
    ];

    public function sendOtp(WhatsAppService $whatsapp)
    {
        $this->validate();

        $otpCode = rand(100000, 999999);
        
        // Store OTP in the database
        $otpRecord = WhatsappOtp::create([
            'mobile_number' => $this->mobile_number,
            'otp' => $otpCode,
            'expires_at' => now()->addMinutes(10),
        ]);

        $whatsapp->sendOtp($this->mobile_number, $otpCode);
        
        $this->showOtpInput = true;
        
        session()->flash('success', 'OTP has been sent to your WhatsApp.');
        
        // In development mode, also show the OTP for manual testing
        if (config('app.env') === 'local') {
            session()->flash('dev_otp', 'DEV MODE: Your OTP is ' . $otpCode);
        }
    }

    public function verifyOtp()
    {
        $this->validate([
            'otp' => 'required|numeric|digits:6',
        ]);
        
        $otpRecord = WhatsappOtp::where('mobile_number', $this->mobile_number)
                    ->where('otp', $this->otp)
                    ->where('expires_at', '>', now())
                    ->whereNull('verified_at')
                    ->latest()
                    ->first();

        if ($otpRecord) {
            $otpRecord->update(['verified_at' => now()]);

            // Login or Create user
            $user = User::where('mobile_number', $this->mobile_number)->first();
            if (!$user) {
                $user = User::create([
                    'name' => 'Customer ' . substr($this->mobile_number, -4),
                    'email' => $this->mobile_number . '@royalcollection.com',
                    'mobile_number' => $this->mobile_number,
                ]);
            }

            Auth::login($user);
            return redirect()->intended(route('home'));
        }

        $this->addError('otp', 'Invalid or expired OTP.');
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('components.layouts.app');
    }
}
