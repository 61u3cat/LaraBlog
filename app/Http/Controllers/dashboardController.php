<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class dashboardController extends Controller
{
    public function datalist()
    {
        return view('administrator.lists');
    }
    public function postview()
    {
        $posts = Post::with('blogCategory.getCategoryName')->where(['user_id' => auth()->user()->id])->orderBy('id', 'DESC')->get();

        return view('administrator.post', compact('posts'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('administrator.edituser', compact('user'));
    }
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('lists')->with('success', 'User deleted successfully.');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        // if validate faild redirect not going down else success going down

        // $data = [
        //     'name' => 'robi',
        //     'email' => 'touhgid123@Wgmail.com'
        // ];

        // $user->name

        if ($request->password) {
            $request->validate([
                'password' => 'required',
                'confirm_password' => 'required|same:password',
            ]);
            // if validate faild redirect not going down


            $data['password'] = Hash::make($request->password);
            // $data = [
            //     'name' => 'robi',
            //     'email' => 'touhgid123@Wgmail.com'
            //     'password' => 'sdo9fias9d0ifujas09d8fyhsad89fyhas9dfy89asdf8'
            // ];
        }

        // $data = [
        //     'name' => 'robi',
        //     'email' => 'touhgid123@Wgmail.com'
        // ];
        $user = User::findOrFail($id);
        $user->update($data);

        // User::where('id', $id)->update($data);

        return redirect()->route('lists')->with('success', 'User updated successfully.');
    }
    public function postedit($id)
    {
        $posts = Post::with('blogCategory.getCategoryName')->where(['user_id' => auth()->user()->id, 'id' => $id])->firstOrFail();
        $categories = Category::all();



        $blogcategory = $posts->blogCategory->pluck('category_id')->toArray();
        // dd($blogcategory);
        // dd($posts->blogCategory[0]->getCategoryName);

        //$posts->blogCategory[0]->category_id == 4

        return view('administrator.editpost', compact('posts', 'categories', 'blogcategory'));
    }
}
