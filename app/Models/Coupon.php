<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable= [
        'name',
        'coupon_code',
        'discount',
        'expiry_date',
        'usage_count',
    ];

    // Relationships with Orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
