@extends('layouts.app')

@section('content')
<h1>Tambah Warga</h1>
<form action="{{ route('pengurus.storeWarga') }}" method="POST">
    @csrf
    <label>Nama</label>
    <input type="text" name="nama" class="form-control" required>
    <label>Alamat Rumah</label>
    <input type="text" name="alamat_rumah" class="form-control" required>
    <label>Username</label>
    <input type="text" name="username" class="form-control" required>
    <label>Password</label>
    <input type="password" name="password" class="form-control" required>
    <button type="submit" class="btn btn-success mt-3">Simpan</button>
</form>
@endsection
