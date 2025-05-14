<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PharIo\Manifest\Author;

class Post extends Model
{
    protected $guarded = [];

    public function blogCategory()
    {
        return $this->hasMany(BlogCategory::class, 'post_id', 'id'); //BlogCategory.post_id->Post.id
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'blog_categories', 'post_id', 'category_id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id','user_id');
    }
}
