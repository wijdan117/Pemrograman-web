<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UpdatePassword extends Controller
{
    public function UpdatePassword(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);
    
        // Cari user berdasarkan ID
        $user = User::findOrFail($id);
    
        // Update password
        $user->password = Hash::make($request->password);
        $user->save();
    
        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Password berhasil diubah!');
    }

}