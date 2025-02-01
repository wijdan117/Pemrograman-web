<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangs = Barang::all(); // Menampilkan semua barang
        return view('admin.index', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga_awal' => 'required|numeric',
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);
    
        // Simpan file gambar
        $path = $request->file('gambar')->store('public/images'); // Menyimpan gambar di folder `storage/app/public/images`
    
        // Simpan data barang ke database
        Barang::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga_awal' => $request->harga_awal,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_akhir' => $request->tanggal_akhir,
            'gambar' => $path, // Menyimpan path gambar
        ]);
    
        return redirect()->route('admin.index')->with('success', 'Barang berhasil ditambahkan.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        $penawarans = $barang->penawarans()->orderBy('harga_penawaran', 'desc')->get();
        return view('admin.show', compact('barang', 'penawarans'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('admin.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga_awal' => 'required|numeric',
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai', // Pastikan tanggal akhir >= tanggal mulai
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $barang = Barang::findOrFail($id);
    
        // Jika ada gambar baru, unggah dan hapus gambar lama
        if ($request->hasFile('gambar')) {
            if ($barang->gambar) {
                Storage::delete($barang->gambar); // Hapus gambar lama
            }
    
            $path = $request->file('gambar')->store('public/images');
            $barang->gambar = $path;
        }
    
        // Update data barang
        $barang->nama = $request->nama;
        $barang->deskripsi = $request->deskripsi;
        $barang->harga_awal = $request->harga_awal;
        $barang->tanggal_mulai = $request->tanggal_mulai;
        $barang->tanggal_akhir = $request->tanggal_akhir;
    
        // Jika tanggal akhir di masa depan, ubah status barang menjadi 'aktif'
        if (now()->lessThanOrEqualTo($request->tanggal_akhir)) {
            $barang->status = 'aktif';
        }
    
        $barang->save();
    
        return redirect()->route('admin.index')->with('success', 'Barang berhasil diperbarui.');
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('admin.index')->with('success', 'Barang berhasil dihapus.');
    }
}
