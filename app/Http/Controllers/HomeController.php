<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $posts = Post::with('user', 'blogCategory.getCategoryName')->latest()->get();
        $categories = Category::with(['posts' => function ($query) {
            $query->latest()->take(6);
        }])->latest()->take(3)->get();

        $trendingPosts = Post::with('user')->orderBy('views', 'DESC')->take(5)->get();
        $trendingCategories = Category::with(['posts' => function ($query) {
            $query->orderBy('views', 'DESC')->take(3); // Fetch top 3 posts per category based on views
        }])->orderBy('views', 'DESC')->take(3)->get(); // Fetch top 3 trending categories
        $categorydropdown = Category::latest()->get();
        // dd($trendingPosts);
        return view('LaraBlog.index', compact('posts', 'categories', 'trendingPosts', 'trendingCategories', 'categorydropdown'));
    }
    public function showBlog($slug)
    {
        $post = Post::with('blogCategory.getCategoryName')->where('slug', $slug)->firstOrFail();
        $post->increment('views');
        $recentPosts = Post::latest()->take(5)->get();

        return view('LaraBlog.blog-details', compact('post', 'recentPosts', 'categorydropdown'));
        $categorydropdown = Category::latest()->get();
    }
    public function categoryPosts($slug)
    {
        $category = Category::where('category_slug', $slug)->firstOrFail(); //6

        $posts = Post::with('blogCategory.getCategoryName')
            ->whereHas('blogCategory', function ($query) use ($category) {
                $query->where('category_id', $category->id);
            })->paginate(3);
        $category->increment('views');
        $recentCategory = $category->latest()->paginate(5);
        $categorydropdown = Category::latest()->get();
        return view('LaraBlog.category-posts', compact('posts', 'category', 'recentCategory', 'categorydropdown'));
    }

    public function about()
    {
        $categorydropdown = Category::latest()->get();

        return view('LaraBlog.about', compact('categorydropdown'));
    }
    public function homeIndex()
    {
        $categorydropdown = Category::latest()->get();

        return view('LaraBlog.indexhome', compact('categorydropdown'));
    }
     public function contact()
    {
        $categorydropdown = Category::latest()->get();

        return view('LaraBlog.contact', compact('categorydropdown'));
    }
}
