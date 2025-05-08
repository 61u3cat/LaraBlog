<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {

        $posts = Post::with('blogCategory.getCategoryName')->get();

        return view('ZenBlog.index', compact('posts'));
    }
    
}
