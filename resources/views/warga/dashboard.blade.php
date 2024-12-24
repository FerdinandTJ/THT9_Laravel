@extends('layouts.app')

@section('content')
<h1>Dashboard Warga</h1>
<a href="{{ route('warga.cashflow') }}" class="btn btn-info">Lihat Cashflow</a>
<a href="{{ route('warga.tagihan') }}" class="btn btn-warning">Lihat Tagihan IPL</a>
<a href="{{ route('warga.riwayatPembayaran') }}" class="btn btn-success">Riwayat Pembayaran</a>
@endsection
