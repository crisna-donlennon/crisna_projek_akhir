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

        if (Auth::attempt($datalog)) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }
        return back()->with('LoginError', 'LoginFailed');
    }

    // REGISTRATION
    public function register(Request $request)
    {
        $datavalidate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|confirmed',
            'roles' => 'required',
            'nomor_hp' => 'required|string'
        ]);

        $datavalidate['password'] = Hash::make($datavalidate['password']);

        User::create($datavalidate);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            $request->session()->regenerate();
            return redirect()->intended('/home')->with('success', 'Sign Up Successfull');
        }
        return back()->with('error', 'Registrasi Gagal!');
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
    public function LoginView()
    {
        return view('login');
    }

    // REDIRECT KE REGISTRATION PAGE
    public function RegistrationView()
    {
        return view('adminregistration');
    }







    // public function delete(Request $request)
    // {
    //     $user = User::find($request->input('user_id'));

    //     if ($user) {
    //         $user->delete();
    //         return redirect('/dashboard')->with('success', 'Post deleted successfully');
    //     } else {
    //         return redirect('/dashboard')->with('error', 'Post not found');
    //     }
    // }





    public function delete(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect('/dashboard')->with('error', 'User not found');
        }

        $user->delete();

        return redirect('/dashboard')->with('success', 'User deleted successfully');
    }




    public function index()
    {
        $user = Auth::user();
        return view('account', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'required|string',
            'nomor_hp' => 'required|string',
            'password' => 'nullable|confirmed|min:8', // You can adjust validation rules for the password
        ]);

        $user->name = $request->input('name');
        $user->alamat = $request->input('alamat');
        $user->nomor_hp = $request->input('nomor_hp');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->route('account.index')->with('success', 'Account updated successfully');
    }







    public function updaterole($id, Request $request)
    {
        $user = User::findOrFail($id);

        // Validate the request
        $request->validate([
            'roles' => ['required', 'in:pengguna,admin'],
        ]);

        // Update the user's role
        $user->update(['roles' => $request->roles]);

        return redirect()->back()->with('success', 'User role updated successfully.');
    }
}
