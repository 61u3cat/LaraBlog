<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EditorController extends Controller
{
    public function editor()
    {
        $categories = Category::get();
        return view('administrator.editor', compact('categories'));
    }
    public function postsave(Request $request)
    {
        $data  = $request->validate([
            'title' => 'required',
            'thumbnail' => 'required|image|mimes:jpg,png,gif,jpeg',
            'editor' => 'required'
        ]);

        if ($request->hasFile('thumbnail')) {
            $file_name = time() . '-' . $request->file('thumbnail')->getClientOriginalName();
            $request->file('thumbnail')->move(public_path('uploads'), $file_name);
            $data['thumbnail'] = $file_name;
        }

        Post::create($data);
        return redirect('editor')->with('success', 'succesfully uploaded');
    }
    public function category()
    {
        $category = Category::all();
        return view('administrator.category', compact('category'));
    }
    public function categorysave(Request $request)
    {
        $data  = $request->validate([
            'category_name' => 'required',
            'category_slug' => 'required'        
        ]);

        $data['category_slug'] = Str::slug($data['category_slug']);
        Category::create($data);
        return redirect('category')->with('success', 'succesfully submitted');
    }

}
