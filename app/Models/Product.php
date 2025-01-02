<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'price',
        'quantity',
        'slug',
        'description',
        'image',
        'sale_percent',
        'status',
        'trending',
    ];
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function productImages(){
        return $this->hasmany(productImage::class);
    }
}
