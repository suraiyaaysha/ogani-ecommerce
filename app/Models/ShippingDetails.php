<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address_1',
        'address_2',
        'city',
        'state',
        'zip',
        'phone'
    ];

    // Relation with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationships with Order model
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
