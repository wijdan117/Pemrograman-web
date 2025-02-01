@extends('layouts.app')

@section('content')
<!-- Main Section -->
<section class="main-section">
    <div class="content">
        <h1 class="text-center mb-4">Detail Barang</h1>
        
        <!-- Detail Barang -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Detail Barang</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>Id Barang</th>
                        <td>{{ $barang->id }}</td>
                    </tr>
                    <tr>
                        <th>Nama Barang</th>
                        <td>{{ $barang->nama }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{ $barang->deskripsi }}</td>
                    </tr>
                    <tr>
                        <th>Harga Awal</th>
                        <td>Rp {{ number_format($barang->harga_awal, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Mulai</th>
                        <td>{{ $barang->tanggal_mulai }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Akhir</th>
                        <td>{{ $barang->tanggal_akhir }}</td>
                    </tr>
                    <tr>
                        <th>Harga Penawaran Tertinggi</th>
                        <td>
                            @if($penawarans->isNotEmpty())
                                Rp {{ number_format($penawarans->max('harga_penawaran'), 2) }}
                            @else
                                Belum ada penawaran
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Pemenang Lelang</th>
                        <td>
                            @if($barang->pemenang_id)
                                {{ $barang->pemenang->name }} 
                            @else
                                Belum ada pemenang
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- Riwayat Penawaran -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Riwayat Penawaran</h4>
            </div>
            <div class="card-body">
                @if($penawarans->isEmpty())
                    <p class="text-muted text-center">Belum ada penawaran untuk barang ini.</p>
                @else
                    <ul class="list-group">
                        @foreach($penawarans as $penawaran)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>{{ $penawaran->user ? $penawaran->user->name : 'Pengguna tidak dikenal' }}</strong>
                                <span class="text-success">Rp {{ number_format($penawaran->harga_penawaran, 2) }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif

        </div>
        </div>
            <div class="text-center">
            <a href="{{ route('barangs.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
</section>
@endsection
