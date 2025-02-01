@extends('template.main')
@section('title', 'Edit Barang')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">@yield('title')</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/admin">Barang</a></li>
            <li class="breadcrumb-item active">@yield('title')</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="text-right">
                <a href="/admin" class="btn btn-warning btn-sm"><i class="fa-solid fa-arrow-rotate-left"></i> Back</a>
              </div>
            </div>
            <form class="needs-validation" novalidate action="{{ route('admin.update', $barang) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="nama">Nama Barang</label>
                      <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{ $barang->nama }}" required>
                      @error('nama')
                      <span class="invalid-feedback text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="harga_awal">Harga Awal</label>
                      <input type="number" name="harga_awal" class="form-control @error('harga_awal') is-invalid @enderror" id="harga_awal" value="{{ $barang->harga_awal }}" required>
                      @error('harga_awal')
                      <span class="invalid-feedback text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="tanggal_mulai">Tanggal Mulai</label>
                      <input type="date" name="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror" id="tanggal_mulai" value="{{ $barang->tanggal_mulai }}" required>
                      @error('tanggal_mulai')
                      <span class="invalid-feedback text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="tanggal_akhir">Tanggal Akhir</label>
                      <input type="date" name="tanggal_akhir" class="form-control @error('tanggal_akhir') is-invalid @enderror" id="tanggal_akhir" value="{{ $barang->tanggal_akhir }}" required>
                      @error('tanggal_akhir')
                      <span class="invalid-feedback text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="deskripsi">Deskripsi</label>
                      <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" cols="10" rows="5" required>{{ $barang->deskripsi }}</textarea>
                      @error('deskripsi')
                      <span class="invalid-feedback text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-right">
                <button class="btn btn-dark mr-1" type="reset"><i class="fa-solid fa-arrows-rotate"></i> Reset</button>
                <button class="btn btn-success" type="submit"><i class="fa-solid fa-floppy-disk"></i> Save Changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
