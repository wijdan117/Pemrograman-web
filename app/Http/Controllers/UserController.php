<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Ambil semua data pengguna
        return view('manage-user', compact('users'));
    }

    public function dashboard()
    {
        // Pastikan user login
        $user = auth()->user(); // Mendapatkan user yang login
        if (!$user) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses dashboard.');
        }

        // Kembalikan view ke folder yang benar
        return view('barangs.dashboard', compact('user'));
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password berhasil diperbarui.');
    }

    public function profile()
    {
        $user = Auth::user(); // Mendapatkan data pengguna yang sedang login
        return view('profile', compact('user'));
    }
}
