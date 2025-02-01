@extends('template.main')
@section('title', 'Barang yang Dilelang')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">@yield('title')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-right">
                                <a href="{{ route('admin.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah Barang</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-striped table-bordered table-hover text-center" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Barang</th>
                                    <th>Deskripsi</th>
                                    <th>Harga Awal</th>
                                    <th>Penawaran Tertinggi</th>
                                    <th>Status</th> <!-- Kolom Status -->
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barangs as $barang)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $barang->nama }}</td>
                                        <td>{{ $barang->deskripsi }}</td>
                                        <td>Rp. {{ number_format($barang->harga_awal, 0, ',', '.') }}</td>
                                        <td>
                                            @if($barang->penawarans->isNotEmpty())
                                                Rp. {{ number_format($barang->penawarans->max('harga_penawaran'), 0, ',', '.') }}
                                            @else
                                                <span class="text-danger">Belum ada penawaran</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(now()->greaterThan($barang->tanggal_akhir)) <!-- Menandakan Lelang Selesai -->
                                                <span class="badge badge-secondary">Lelang Selesai</span>
                                            @else
                                                <span class="badge badge-success">Lelang Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.edit', $barang->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fa-solid fa-pen"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.destroy', $barang->id) }}" method="POST" class="d-inline form-delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm btn-delete">
                                                    <i class="fa-solid fa-trash-can"></i> Hapus
                                                </button>
                                            </form>
                                            <a href="{{ route('admin.show', $barang) }}" class="btn btn-info btn-sm">
                                                <i class="fa-solid fa-eye"></i> Detail
                                            </a>
                                            <a href="{{ route('barangs.dashboard') }}" class="btn btn-info btn-sm"">
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('.form-delete');

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Kirim form jika dikonfirmasi
                    }
                });
            });
        });
    });
</script>
