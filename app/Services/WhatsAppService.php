<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    public function sendOtp($mobileNumber, $otp)
    {
        // This is a mock service. In production, you would use Twilio or a WhatsApp API provider.
        Log::info("MOCK WHATSAPP OTP SENT: To $mobileNumber, Code: $otp");
        
        // For local development, we can also flash it to session or just rely on logs.
        session()->flash('otp_debug', "DEBUG: OTP for $mobileNumber is $otp");
        
        return true;
    }
}
