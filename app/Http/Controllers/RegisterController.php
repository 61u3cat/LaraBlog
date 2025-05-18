<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Mail\ResetPassword;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;
use function Laravel\Prompts\password;
use Illuminate\Support\Facades\Password;

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
            return redirect('login')->with('invalid', 'Password and email doent match');
        }
    }
    public function dataview()
    {
        $users = User::all();
        return view('administrator.lists', compact('users'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        return redirect()->route('login')->with('Success', 'Logged out successfully');
    }
    public function forgotPassword()
    {
        return view('administrator.forgot-password');
    }

    // Handles the request to send a password reset token to the user's email
    public function forgotPasswordToken(Request $request)
    {
        // Validate the email input, ensure it exists in the users table
        $data = $request->validate([
            'email' => 'required|email|exists:users'
        ]);

        // Generate a token using a hash of the email
        $data['token'] = bin2hex(random_bytes(6));

        // Check if a password reset entry already exists for this email
        $check = PasswordReset::where('email', $data['email'])->first();
        if ($check) {
            // If exists, delete the old entry and create a new one
            $check = PasswordReset::where('email', $data['email'])->delete();
            PasswordReset::create($data);
        } else {
            // If not, simply create a new entry
            PasswordReset::create($data);
        }

        // Send the reset password email with the token
        Mail::to($data['email'])->send(new ResetPassword($data['email'], $data['token']));

        // Redirect back to login with a message
        return redirect('login')->with('message', 'Please check your email');
    }

    public function recoverPassword($email, $token)
    {

        $check = PasswordReset::where(['email' => $email, 'token' => $token])->firstOrFail();

        return view('administrator.recover-password', compact('email', 'token'));
    }
    public function recoverPasswordSave(Request $request, $email, $token)
    {
        $data = $request->validate([
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);
        unset($data['confirm_password']);
        $check = PasswordReset::where(['email' => $email, 'token' => $token])->firstOrFail();

        $data['password'] =  Hash::make($data['password']);
        PasswordReset::where('email', $email)->delete();
        User::where('email', $email)->update($data);
        return redirect('login')->with('message', 'Thank you password changed.');
    } 
}
