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
        'discount',
        'quantity',
        'featured_image',
        'gallery_images',
        'weight',
        'color',
        'product_size',
        'shipping_duration',
        'shipping_charge',
        'status',

        'user_id',

        'product_category_id'

    ];

    // Wih user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // With Product Category
    public function productCategory()
    {
        // return $this->belongsTo(ProductCategory::class);
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
    }

    // with tags
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }


    // with orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // With Wishlists
    public function wishlists(): BelongsToMany
    {
        return $this->belongsToMany(Wishlist::class, 'wishlist_product')->withTimestamps();
    }


    public function reviews()
    {
        // return $this->hasMany(Comment::class)->whereNull('parent_id');
        return $this->hasMany(Review::class)->whereNull('parent_id')->latest();
    }

}
