<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'session_id',
        'ip_address',
        'user_agent',
        'device_type',
        'browser',
        'os',
        'country',
        'city',
        'referrer',
        'referrer_domain',
        'first_visit',
        'last_visit',
        'page_views',
    ];

    protected $casts = [
        'first_visit' => 'datetime',
        'last_visit' => 'datetime',
    ];

    public function pageViews()
    {
        return $this->hasMany(PageView::class);
    }
}
