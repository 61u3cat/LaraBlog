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
    // Validate the incoming request data with specific rules
    $data  = $request->validate([
        'title' => 'required', // Title is required
        'slug' => 'required', // Slug is required
        'thumbnail' => 'required|image|mimes:jpg,png,gif,jpeg', // Thumbnail must be an image of specified types
        'editor' => 'required', // Editor content is required
        'category' => 'required|array', // Category must be an array and is required
        'category.*' => 'required', // Each category item must be required
    ]);

    // Remove the category key from the validated data since it's handled separately
    unset($data['category']);

    // Attach the authenticated user's ID to the post data
    $data['user_id'] = auth()->user()->id;

    // Convert the slug into a URL-friendly format
    $data['slug'] = Str::slug($data['slug']);

    // Check if a thumbnail file is uploaded
    if ($request->hasFile('thumbnail')) {
        // Create a unique filename using the current timestamp and original name
        $file_name = time() . '-' . $request->file('thumbnail')->getClientOriginalName();

        // Move the uploaded file to the public 'uploads' directory
        $request->file('thumbnail')->move(public_path('uploads'), $file_name);

        // Store the filename in the post data
        $data['thumbnail'] = $file_name;
    }

    // Create a new post record in the database
    $post = Post::create($data);

    // Loop through each category selected and associate it with the post
    foreach ($request->category as $category) {
        BlogCategory::create(['post_id' => $post->id, 'category_id' => $category]);
    }

    // Update the post with the same data (This seems redundant and might be unnecessary)
    // $post  = Post::findOrFail($id); // This line is commented out and may not be needed
    $post->update($data);

    // Redirect to the 'editor' page with a success message
    return redirect('editor')->with('success', 'Successfully uploaded');
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
