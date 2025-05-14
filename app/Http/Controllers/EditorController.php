<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
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
            'slug' => 'required',
            'thumbnail' => 'required|image|mimes:jpg,png,gif,jpeg',
            'editor' => 'required',
            'category' => 'required|array',
            'category.*' => 'required',
        ]);
        unset($data['category']);
        $data['user_id'] = auth()->user()->id;
        $data['slug'] = Str::slug($data['slug']);

        if ($request->hasFile('thumbnail')) {
            $file_name = time() . '-' . $request->file('thumbnail')->getClientOriginalName();
            $request->file('thumbnail')->move(public_path('uploads'), $file_name);
            $data['thumbnail'] = $file_name;
        }

        $post = Post::create($data);
        foreach ($request->category as $category) {
            BlogCategory::create(['post_id' => $post->id, 'category_id' => $category]);
        }


        // $post  = Post::findOrFail($id);
        $post->update($data);
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
            'category_name' => 'required|unique:categories',
            'category_slug' => 'required'
        ]);

        $data['category_slug'] = Str::slug($data['category_slug']);
        Category::create($data);
        return redirect('category')->with('success', 'succesfully submitted');
    }
    public function PostUpdateSave(Request $request, $id)
    {
        $data  = $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'thumbnail' => 'nullable|image',
            'editor' => 'required',
            'category' => 'required|array',
            'category.*' => 'required',
        ]);
        unset($data['category']);

        $data['slug'] = Str::slug($data['slug']);

        if ($request->hasFile('thumbnail')) {
            $file_name = time() . '-' . $request->file('thumbnail')->getClientOriginalName();
            $request->file('thumbnail')->move(public_path('uploads'), $file_name);
            $data['thumbnail'] = $file_name;
        }

        $post = Post::where(['user_id' => auth()->user()->id, 'id' => $id])->update($data);
        $check = BlogCategory::where(['post_id' => $id])->delete(); //sotti
        foreach ($request->category as $category) {
            BlogCategory::create(['post_id' => $id, 'category_id' => $category]);
        }

        return redirect()->route('posts')->with('success', 'succesfully uploaded');
    }
}
