<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penawaran;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class PenawaranController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $barang = Barang::findOrFail($request->barang_id);
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'harga_penawaran' => 'required|numeric|min:' . $barang->harga_awal,
        ]);
        
        // Simpan penawaran dengan relasi user_id
        Penawaran::create([
            'barang_id' => $request->barang_id,
            'user_id' => Auth::id(), // Simpan ID pengguna yang login
            'harga_penawaran' => $request->harga_penawaran,
        ]);
    
        // Cek apakah penawaran ini adalah yang tertinggi, dan update pemenang jika perlu
        $penawaranTertinggi = Penawaran::where('barang_id', $barang->id)
                                        ->orderByDesc('harga_penawaran')
                                        ->first();
        
        if ($penawaranTertinggi) {
            $barang->pemenang_id = $penawaranTertinggi->user_id;
            $barang->save();
        }
        
        return redirect()->route('barangs.show', $request->barang_id)
            ->with('success', 'Penawaran berhasil diajukan!');
    }
        public function create($barangId)
    {
        // Ambil data barang berdasarkan ID
        $barang = Barang::findOrFail($barangId);

        // Tampilkan halaman form penawaran
        return view('barangs.tawar', compact('barang'));
    }
    public function index()
    {
        // Ambil semua penawaran yang dibuat oleh user yang login
        $penawarans = Penawaran::where('user_id', auth()->id())->get();

        return view('penawaran-saya', compact('penawarans'));
    }
}
