<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'status',
        'grand_total',
        'item_count',
        'payment_status',
        'payment_method',

        'stripe_payment_intent_id',
        'payment_intent_id',

        'first_name',
        'last_name',
        'phone',
        'country',
        'address_1',
        'address_2',
        'city',
        'state',
        'zip',
        'notes'
        // other order fields
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relationships with Coupon
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    // Relation with Order Items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Relationships with billingDetails model
     public function billingDetails()
    {
        return $this->hasOne(BillingDetails::class);
    }

    // Relationships with ShippingDetails model
     public function ShippingDetails()
    {
        return $this->hasOne(ShippingDetails::class);
    }

}
