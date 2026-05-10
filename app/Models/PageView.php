<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    protected $fillable = [
        'visitor_id',
        'url',
        'title',
        'referrer',
        'time_on_page',
        'viewed_at',
    ];

    protected $casts = [
        'viewed_at' => 'datetime',
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
}
