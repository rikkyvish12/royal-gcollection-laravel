<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($category) {
            $category->slug = \Illuminate\Support\Str::slug($category->name);
        });
    }

    protected $fillable = ['name', 'slug', 'image', 'super_category_id'];

    public function superCategory()
    {
        return $this->belongsTo(SuperCategory::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
