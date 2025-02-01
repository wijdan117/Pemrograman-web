@extends('layouts.app')

@section('content')

<div class="card-body">
    <h1 class="text-center">Daftar Barang</h1>
    <div class="row">
        @foreach($barangs as $barang)
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-center mb-3">
                        @if($barang->gambar)
                            <img src="{{ Storage::url($barang->gambar) }}" alt="{{ $barang->nama }}" class="img-fluid" style="max-width: 200px;">
                        @else
                            <span class="text-muted">Tidak ada gambar</span>
                        @endif
                    </div>
                    <div>
                        <h3 class="card-title">{{ $barang->nama }}</h3><br>
                        <p class="card-text">{{ $barang->deskripsi }}</p>
                        <p class="card-text"><strong>Harga Awal:</strong><span class="text-success"> Rp {{ number_format($barang->harga_awal, 2) }}</span></p>
                        <p class="card-text"><strong>Mulai:</strong><span class="text-secondary"> {{ $barang->tanggal_mulai }}</span></p>
                        <p class="card-text"><strong>Akhir:</strong><span class="text-danger"> {{ $barang->tanggal_akhir }}</span></p>
                        <p class="card-text text-danger">
                            <strong>Sisa Waktu:</strong>
                            <span class="countdown" data-end="{{ $barang->tanggal_akhir }}"></span>
                        </p>
                        <div class="progress mb-2">
                            <div 
                                class="progress-bar" 
                                role="progressbar" 
                                style="width: 0%;" 
                                aria-valuemin="0" 
                                aria-valuemax="100" 
                                data-start="{{ $barang->tanggal_mulai }}" 
                                data-end="{{ $barang->tanggal_akhir }}">
                            </div>
                        </div>
                        <p class="card-text">
                            <strong>Harga Penawaran Tertinggi:</strong> 
                            @if($barang->penawarans->isNotEmpty())
                                <span class="text-info">Rp {{ number_format($barang->penawarans->max('harga_penawaran'), 2) }}</span>
                            @else
                                <span class="text-danger">Belum ada penawaran</span>
                            @endif
                        </p>

                        @if($barang->penawarans->isNotEmpty())
                            @php
                                $penawaranTertinggi = $barang->penawarans->sortByDesc('harga_penawaran')->first();
                                $userAdalahPenawarTertinggi = $penawaranTertinggi->user_id == auth()->id();
                            @endphp

                            @if($userAdalahPenawarTertinggi)
                                <p class="text-success"><strong>Status:</strong> Anda adalah penawar tertinggi!</p>
                            @else
                                <p class="text-warning"><strong>Status:</strong> Anda bukan penawar tertinggi.</p>
                            @endif
                        @endif

                        @if(now()->greaterThan($barang->tanggal_akhir))
                            <p class="text-danger"><strong>Status:</strong> Lelang Selesai</p>
                            
                            @if($barang->pemenang_id)  <!-- Menampilkan nama pemenang -->
                                @php
                                    $pemenang = \App\Models\User::find($barang->pemenang_id);
                                @endphp
                                <p><strong>Pemenang:</strong> {{ $pemenang ? $pemenang->name : 'Tidak ada pemenang' }}</p>
                            @else
                                <p><strong>Pemenang:</strong> Tidak ada pemenang (mungkin lelang gagal).</p>
                            @endif

                            <button class="btn btn-secondary" disabled>Lelang Selesai</button>
                        @else
                            <p class="text-success"><strong>Status:</strong> Lelang Berjalan</p>
                            <a href="{{ route('barangs.tawar', $barang->id) }}" class="btn btn-success">Masukkan Penawaran</a>
                        @endif
                        <a href="{{ route('barangs.show', $barang) }}" class="btn btn-primary">Detail</a>
                        <a href="{{ route('barangs.dashboard') }}" class="btn btn-info btn-sm"">detai</a>

                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
