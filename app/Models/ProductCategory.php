<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
    'name',
    'slug',
    'thumbnail',
    'status',
    'is_featured',
    // 'product_id',
    ];


    // With Products
    public function products()
    {
        return $this->hasMany(Product::class);
    }


}
