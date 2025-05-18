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
        $sliderposts = Post::latest()->take(4)->get();
        //dd($sliderposts);
        return view('LaraBlog.index', compact('posts', 'categories', 'trendingPosts', 'trendingCategories', 'categorydropdown', 'sliderposts'));
    }
    public function showBlog($slug)
    {
        $post = Post::with('blogCategory.getCategoryName')->where('slug', $slug)->firstOrFail();
        $post->increment('views');
        $recentPosts = Post::latest()->take(5)->get();

        $categorydropdown = Category::latest()->get();
        $sliderposts = Post::latest()->take(4)->get();

        return view('LaraBlog.blog-details', compact('post', 'recentPosts', 'categorydropdown', 'sliderposts'));
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
        $sliderposts = Post::latest()->take(4)->get();

        return view('LaraBlog.category-posts', compact('posts', 'category', 'recentCategory', 'categorydropdown', 'sliderposts'));
    }


    public function about()
    {
        $categorydropdown = Category::latest()->get();
        $sliderposts = Post::latest()->take(4)->get();

        return view('LaraBlog.about', compact('categorydropdown', 'sliderposts'));
    }

    public function homeIndex()
    {
        $categorydropdown = Category::latest()->get();
        $sliderposts = Post::latest()->take(4)->get();

        return view('LaraBlog.indexhome', compact('categorydropdown', 'sliderposts'));
    }

    public function contact()
    {
        $categorydropdown = Category::latest()->get();
        $sliderposts = Post::latest()->take(4)->get();

        return view('LaraBlog.contact', compact('categorydropdown', 'sliderposts'));
    }
    public function BlogWrite()
    {
        return view('administrator.login')->with('message', 'Please Login first');
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $posts = \App\Models\Post::where('title', 'like', "%{$query}%")
            ->orWhere('editor', 'like', "%{$query}%")
            ->orWhereHas('blogCategory.getCategoryName', function ($q) use ($query) {
                $q->where('category_name', 'like', "%{$query}%");
            })
            ->latest()
            ->paginate(10);

        $categorydropdown = \App\Models\Category::latest()->get();
        $sliderposts = \App\Models\Post::latest()->take(4)->get();

        return view('LaraBlog.search-results', compact('posts', 'query', 'categorydropdown', 'sliderposts'));
    }
}
