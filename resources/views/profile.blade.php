@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">Profil Pengguna</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    
                    <ul class="list-unstyled">
                        <li><strong><h5 class="text-center mb-2">Informasi Pengguna</h5></strong></li><br>
                        <li><strong>Nama:</strong> {{ $user->name }}</li><br>
                        <li><strong>Email:</strong> {{ $user->email }}</li><br>
                        <li><strong>Nomor Telepon:</strong> {{ $user->phone ?? 'Belum ditambahkan' }}</li><br>
                        <li><strong>Alamat:</strong> {{ $user->address ?? 'Belum ditambahkan' }}</li><br><br>
                        <li><strong>Peran:</strong> {{ $user->role }}</li><br>
                        <li><strong>Terdaftar Sejak:</strong> {{ $user->created_at->format('d M Y') }}</li>
                    </ul><br>

                    <div class="mt-4">
                        <h5 class="text-center mb-2">Statistik Pengguna</h5>
                        <ul class="list-unstyled">
                            <li><strong>Jumlah Penawaran:</strong> {{ $user->penawarans->count() }}</li><br>
                            <li><strong>Lelang Dimenangkan:</strong> {{ $user->lelang_menang_count }}</li>
                        </ul>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
