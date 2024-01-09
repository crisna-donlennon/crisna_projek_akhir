<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
// LOGINATION
    public function login(Request $request)
    {
        $datalog = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($datalog)) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }    
        return back()->with('LoginError' , 'LoginFailed');
    }

// REGISTRATION
    public function register(Request $request)
    {
        $datavalidate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|confirmed',
            'roles' => 'required',
            'alamat' => 'required|string',
            'nomor_hp' => 'required|string'
        ]);        

        $datavalidate['password'] = Hash::make($datavalidate['password']);

        User::create($datavalidate);

        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            $request->session()->regenerate();
            return redirect()->intended('/home')->with('success', 'Sign Up Successfull');
        }            
        return back()->with('LoginError' , 'LoginFailed');
    }

// LOGOUTATION
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->flush();
        return redirect('/login');
    }

    public function profile(Request $request)
    {
        return $request->user();
    }

// REDIRECT KE LOGIN PAGE
    public function LoginView(){
        return view('login');
    }

// REDIRECT KE REGISTRATION PAGE
    public function RegistrationView(){
        return view('adminregistration');
    }







    public function delete($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect('/dashboard')->with('success', 'Post deleted successfully');
        } else {
            return redirect('/dashboard')->with('error', 'Post not found');
        }
    }

}