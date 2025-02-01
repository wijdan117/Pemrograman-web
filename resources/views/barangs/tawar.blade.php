@extends('layouts.app')

@section('content')
<!-- Main Section -->
<section class="main-section">
    <div class="content">
        <h1 class="text-center mb-4 text-primary">Masukkan Penawaran</h1>

        <!-- Form Penawaran -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-secondary text-white">
                <h4 class="mb-0">Masukkan Penawaran Anda</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('penawaran.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="barang_id" value="{{ $barang->id }}">

                    <div class="mb-3">
                        <label for="harga_penawaran" class="form-label">Penawaran (Rp):</label>
                        <input type="number" id="harga_penawaran" name="harga_penawaran" class="form-control" 
                               required min="{{ $barang->harga_awal }}" step="0.01" placeholder="Masukkan harga penawaran Anda">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Tawar</button>
                </form>
            </div>
        </div>

        <!-- Kembali Button -->
        <div class="text-center">
            <a href="{{ route('barangs.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</section>
@endsection
