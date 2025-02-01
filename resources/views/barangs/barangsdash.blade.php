@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard Barang</h1>
    <div class="d-flex justify-content-between mb-3">
        <h3>Daftar Barang</h3>
        <a href="{{ route('barangs.create') }}" class="btn btn-primary">Tambah Barang</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Nama Barang</th>
                <th>Deskripsi</th>
                <th>Harga Awal</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Akhir</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($barangs as $key => $barang)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $barang->nama }}</td>
                    <td>{{ $barang->deskripsi }}</td>
                    <td>Rp {{ number_format($barang->harga_awal, 2) }}</td>
                    <td>{{ $barang->tanggal_mulai }}</td>
                    <td>{{ $barang->tanggal_akhir }}</td>
                    <td>
                        <a href="{{ route('barangs.show', $barang->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('barangs.edit', $barang->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('barangs.destroy', $barang->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada barang tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
