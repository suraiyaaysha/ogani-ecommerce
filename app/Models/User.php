<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\UserDetails;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'profile_photo',

        // 'profile_photo',
        // 'phone',
        // 'country',
        // 'address_1',
        // 'address_2',
        // 'city',
        // 'state',
        // 'zip',

        'is_admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',

        // 'is_admin' => 'boolean'

    ];


    // Relation with user details
    public function userDetails()
    {
        return $this->hasOne(UserDetails::class);
    }

    // With Products
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // With Order
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // With billing details model
    public function billingDetails()
    {
        return $this->hasOne(BillingDetails::class);
    }

    // Relation with Shipping details
    public function shippingDetails()
    {
        return $this->hasOne(ShippingDetails::class);
    }

    // with Wishlists
    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }


    // Relation between User and Blog
    public function blogs(){
        // return $this->hasMany(Blog::class, 'user_id', 'id');
        return $this->hasMany(Blog::class);
    }

    // With contact form
    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }


}
