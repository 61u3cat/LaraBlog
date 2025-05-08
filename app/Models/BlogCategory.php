<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    //
    protected $guarded = [];

    public function getCategoryName()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id'); //BlogCategory.category_id->Category.id
    }
}


