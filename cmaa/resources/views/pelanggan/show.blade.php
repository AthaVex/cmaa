@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2>Kode Anda: {{ $pelanggan->kode }}</h2>
    <p>Total Cuci: <strong>{{ $total }}</strong> kali</p>

    @if($total >= 6)
        <div class="alert alert-success">
            🎉 Selamat! Anda mendapat CUCI GRATIS ke-{{ $total }}!
        </div>
    @else
        <p>Tinggal {{ 6 - $total }}x lagi untuk dapat gratis.</p>
    @endif

    <a href="{{ route('pelanggan.scan') }}" class="btn btn-primary mt-3">Scan Lagi</a>
</div>
@endsection
