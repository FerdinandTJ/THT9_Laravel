@extends('layouts.app')

@section('content')
<h1>Dashboard Admin</h1>
<a href="{{ route('admin.createPengurus') }}" class="btn btn-primary">Tambah Pengurus Perumahan</a>
@endsection
