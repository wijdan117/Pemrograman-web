@extends('template.main')

@section('content')
<div class="content-wrapper">
    <div class="card-body">
        <div class="container">
            <h1 class="text-center mb-4">Detail Barang</h1>

            <div class="table-responsive mb-4">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th class="bg-light" style="width: 30%;">Nama</th>
                            <td>{{ $barang->nama }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Deskripsi</th>
                            <td>{{ $barang->deskripsi }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Harga Awal</th>
                            <td>Rp {{ number_format($barang->harga_awal, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Tanggal Mulai</th>
                            <td>{{ $barang->tanggal_mulai }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Tanggal Akhir</th>
                            <td>{{ $barang->tanggal_akhir }}</td>
                        </tr>
                    </tbody>
                </table>
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
                        <ul class="list-group list-group-flush">
                            @foreach($penawarans as $penawaran)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>{{ $penawaran->user ? $penawaran->user->name : 'Pengguna tidak dikenal' }}</strong>
                                    <span class="badge badge-success">Rp {{ number_format($penawaran->harga_penawaran, 2, ',', '.') }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <!-- Tombol Kembali -->
            <div class="text-center">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
