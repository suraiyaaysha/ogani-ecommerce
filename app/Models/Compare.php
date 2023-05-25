<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compare extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'product_id'];

    // relation with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // relation with product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
