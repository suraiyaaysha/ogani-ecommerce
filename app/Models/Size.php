<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Size extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    // with products
    public function products() {
        return $this->belongsToMany(Product::class, 'product_size');
    }
}
