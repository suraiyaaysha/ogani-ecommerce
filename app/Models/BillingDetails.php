<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'city',
        'state',
        'zip'
    ];

    // With User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
