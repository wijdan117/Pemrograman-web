<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Barang;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman edit profil.
     */
    public function edit()
    {
        $user = Auth::user(); // Mendapatkan data pengguna yang sedang login
    
        // Muat relasi penawaran pengguna
        $user->load('penawarans'); 
    
        // Hitung jumlah lelang yang dimenangkan
        $user->lelang_menang_count = Barang::where('pemenang_id', $user->id)
            ->where('tanggal_akhir', '<=', now()) // Hanya hitung lelang yang sudah selesai
            ->count();
    
        return view('profile.edit', compact('user'));
    }
    

    /**
     * Mengambil data pengguna dengan statistik tambahan.
     */
    private function getUserWithStats($user)
    {
        $user->load('penawarans'); // Muat relasi penawaran
        $user->lelang_menang_count = $user->barangDimenangkan()
            ->where('tanggal_akhir', '<=', now()) // Hanya lelang yang telah berakhir
            ->count();
        return $user;
    }

    /**
     * Proses update profil pengguna.
     */
    public function update(Request $request)
    {
        $user = Auth::user(); // Mengambil pengguna yang sedang login

        // Validasi data input dari pengguna
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|regex:/^[0-9\-\+]{9,15}$/|max:15',
            'address' => 'nullable|string|max:255',
        ]);

        try {
            // Perbarui data pengguna dengan properti individual
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->phone = $validatedData['phone'] ?? $user->phone;
            $user->address = $validatedData['address'] ?? $user->address;

            // Simpan perubahan ke database
            $user->save();

            return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('profile.edit')->with('error', 'Terjadi kesalahan saat memperbarui profil: ' . $e->getMessage());
        }
    }
}
