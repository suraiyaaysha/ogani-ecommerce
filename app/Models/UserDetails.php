<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class UserDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_photo',
        'phone',
        'country',
        'address_1',
        'address_2',
        'city',
        'state',
        'zip',
    ];

    // relation with user table
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
