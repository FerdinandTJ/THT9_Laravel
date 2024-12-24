@extends('layouts.app')

@section('content')
<h1>Dashboard Pengurus</h1>
<a href="{{ route('pengurus.createWarga') }}" class="btn btn-primary">Tambah Warga</a>
<a href="{{ route('pengurus.cashflow') }}" class="btn btn-secondary">Kelola Cashflow</a>
<a href="{{ route('pengurus.tagihan') }}" class="btn btn-info">Kelola Tagihan</a>
@endsection
