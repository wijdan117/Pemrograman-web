<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use Illuminate\Console\View\Components\Alert as ComponentsAlert;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\alert;

class AuthController extends Controller
{
    public function index()
    {

        return view('auth.login', [
            'title' => 'Login',
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
    
            // Periksa peran pengguna
            $user = Auth::user();
            if ($user->role === 'admin') {
                Alert::success('Success', 'Login success as Admin!');
                return redirect()->intended('/dashboard');
            } else {
                Alert::success('Success', 'Login success as User!');
                return redirect()->intended('/barangs');
            }
        }
    
        Alert::error('Error', 'Login failed!');
        return redirect('/login');
    }
    

    public function register()
    {
        return view('auth.register', [
            'title' => 'Register',
        ]);
    }

    public function process(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'passwordConfirm' => 'required|same:password',
        ]);
    
        $validated['password'] = Hash::make($request['password']);
        $validated['role'] = 'user'; // Tambahkan role default "user"
    
        User::create($validated);
    
        Alert::success('Success', 'Register user has been successfully!');
        return redirect('/login');
    }
    

    public function logout(Request $request)
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
        Alert::success('Success', 'Log out success !');
        return redirect('/login');
    }
}
