<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_description',
        'long_description',
        'status',
        'stock',
        'price',
        'discount',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_products', 'product_id', 'category_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function singleImage()
    {
        return $this->hasOne(ProductImage::class);
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }
}
