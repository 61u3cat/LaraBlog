<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register()
    {
        return view('administrator.register');
    }
    public function regsave(Request $request)
    {
        // dd($request->all());
        $data  = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:4',
            'confirm_password' => 'min:4|same:password'

        ]);
        User::create($data);
        return redirect('login')->with('success', 'Register successful, Now Login');
    }
    public function login()
    {
        return view('administrator.login');
    }
    public function loginsave(Request $request)
    {
        $data = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect('lists');
        } else {
            return redirect('login')->with('invalid','Password and email doent match');
        }
    }
    public function dataview()
    {
        $users = User::all();
        return view('administrator.lists', compact('users'));
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('administrator.edit', compact('user'));
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
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user = User::findOrFail($id);
        $user->update($data);

        return redirect()->route('lists')->with('success', 'User updated successfully.');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        return redirect()->route('login.view')->with('Success', 'Logged out successfully');
    }
    public function forgotPassword()
    {
        return view('administrator.forgot-password');
    }
    public function recoverPassword()
    {
        return view('administrator.recover-password');
    }
  
}
