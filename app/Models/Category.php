<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'blog_categories','category_id','post_id');
    }
    
}
