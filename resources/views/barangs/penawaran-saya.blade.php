@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Penawaran Saya</h1>
    @if($penawarans->isEmpty())
        <p class="text-muted">Anda belum melakukan penawaran.</p>
    @else
        <ul class="list-group">
            @foreach($penawarans as $penawaran)
                <li class="list-group-item">
                    Barang: {{ $penawaran->barang->nama }} <br>
                    Harga Penawaran: Rp {{ number_format($penawaran->harga_penawaran, 2) }} <br>
                    Tanggal: {{ $penawaran->created_at->format('d M Y, H:i') }}
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
