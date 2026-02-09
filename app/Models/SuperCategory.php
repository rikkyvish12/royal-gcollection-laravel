<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuperCategory extends Model
{
    protected $fillable = ['name', 'slug', 'description'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($superCategory) {
            $superCategory->slug = \Illuminate\Support\Str::slug($superCategory->name);
        });
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, Category::class);
    }
}
