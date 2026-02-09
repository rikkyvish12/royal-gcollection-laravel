<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsappOtp extends Model
{
    protected $fillable = ['mobile_number', 'otp', 'expires_at', 'verified_at'];

    protected $casts = [
        'expires_at' => 'datetime',
        'verified_at' => 'datetime',
    ];
}
