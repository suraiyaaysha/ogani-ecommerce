<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'information',
        'price',
        'quantity',
        'featured_image',
        'gallery_images',
        'weight',
        'color',
        'product_size',
        'shipping_duration',
        'shipping_charge',
        'status',
        // 'product_category_id'
    ];

    // Wih user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // with orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }


}
