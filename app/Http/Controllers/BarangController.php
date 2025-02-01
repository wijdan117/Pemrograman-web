<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Penawaran;
use Illuminate\Support\Facades\Log;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menampilkan semua barang dengan status aktif
        $barangs = Barang::where('status', 'aktif')->get();
        return view('barangs.index', compact('barangs'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $barang = Barang::with('penawarans')->findOrFail($id);
    
        // Cek apakah lelang sudah selesai
        if (now()->greaterThan($barang->tanggal_akhir) && $barang->status === 'aktif') {
            $barang->status = 'selesai';
            $barang->save();

            // Log perubahan status
            Log::info("Status barang dengan ID {$barang->id} telah diubah menjadi selesai karena lelang telah berakhir.");
        }
    
        $penawarans = $barang->penawarans()->orderBy('harga_penawaran', 'desc')->get();
        return view('barangs.show', compact('barang', 'penawarans'));
    }

    /**
     * Function untuk menawar barang.
     */
    public function bid(Request $request, $id)
    {
        $request->validate([
            'harga_penawaran' => 'required|numeric|min:0',
        ]);
    
        $barang = Barang::findOrFail($id);
    
        // Pastikan barang masih dalam status aktif dan lelang belum berakhir
        if ($barang->status !== 'aktif' || now()->greaterThan($barang->tanggal_akhir)) {
            Log::warning("Penawaran gagal untuk barang ID {$barang->id}: Lelang telah berakhir atau barang tidak aktif.");
            return redirect()->back()->with('error', 'Barang ini tidak dapat ditawar, karena lelang telah berakhir.');
        }
    
        // Buat penawaran baru
        $barang->penawarans()->create([
            'user_id' => auth()->id(),
            'harga_penawaran' => $request->harga_penawaran,
        ]);

        Log::info("Penawaran berhasil dilakukan pada barang ID {$barang->id} oleh user ID " . auth()->id());

        return redirect()->route('barangs.show', $barang)->with('success', 'Penawaran berhasil dilakukan.');
    }

    /**
     * Tentukan pemenang setelah lelang berakhir.
     */
    public function tentukanPemenang($barangId)
    {
        $barang = Barang::findOrFail($barangId);
    
        // Pastikan lelang sudah berakhir
        if (now()->lessThanOrEqualTo($barang->tanggal_akhir)) {
            Log::warning("Penentuan pemenang gagal untuk barang ID {$barang->id}: Lelang masih berlangsung.");
            return redirect()->route('barangs.show', $barangId)
                             ->with('error', 'Lelang masih berlangsung. Pemenang hanya dapat ditentukan setelah lelang berakhir.');
        }
    
        $penawaranTertinggi = $barang->penawarans()
                                     ->orderByDesc('harga_penawaran')
                                     ->first();
    
        if ($penawaranTertinggi) {
            $barang->pemenang_id = $penawaranTertinggi->user_id;
            $barang->status = 'selesai';
            $barang->save();

            Log::info("Pemenang berhasil ditentukan untuk barang ID {$barang->id}. User ID {$penawaranTertinggi->user_id} menjadi pemenang.");
        } else {
            Log::info("Tidak ada penawaran untuk barang ID {$barang->id}. Tidak ada pemenang yang ditentukan.");
        }
    
        return redirect()->route('barangs.show', $barang->id)
                         ->with('success', 'Pemenang lelang berhasil ditentukan.');
    }
    public function dashboard()
    {
        return view('barangs.dashboard');
    }    
    
    
}
