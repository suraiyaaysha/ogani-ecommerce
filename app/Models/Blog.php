<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'details',
        'thumbnail',
        // 'blog_category_id'

    ];

    public function blogCategory()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    // with tags
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    // Relation between Blog and User
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments()
    {
        // return $this->hasMany(Comment::class)->whereNull('parent_id');
        return $this->hasMany(Comment::class)->whereNull('parent_id')->latest();
    }

}
