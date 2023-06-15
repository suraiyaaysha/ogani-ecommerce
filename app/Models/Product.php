<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Color;
use App\Models\Size;

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
        'shipping_duration',
        'shipping_charge',
        'is_featured',
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

    // with sizes
    public function sizes() {
        return $this->belongsToMany(Size::class, 'product_size');
    }

    // with colors
    public function colors() {
        return $this->belongsToMany(Color::class, 'product_color');
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

    // a new accessor method to retrieve the gallery images as an array:
    public function getGalleryImagesAttribute($value)
    {
        return json_decode($value, true) ?? [];
    }

    // To calculate the discounted price for a product, you can add a new accessor method
    public function getDiscountedPriceAttribute()
    {
        if ($this->discount > 0) {
            return $this->price - (($this->price * $this->discount) / 100);
        }

        return $this->price;
    }

}
