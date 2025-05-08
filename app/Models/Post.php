<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    public function blogCategory()
    {
        return $this->hasMany(BlogCategory::class, 'post_id', 'id'); //BlogCategory.post_id->Post.id
    }


}
