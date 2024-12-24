@extends('layouts.app')

@section('content')
<h1>Tambah Pengurus Perumahan</h1>
<form action="{{ route('admin.storePengurus') }}" method="POST">
    @csrf
    <label>Nama Perumahan</label>
    <input type="text" name="nama_perumahan" class="form-control" required>
    <label>Alamat</label>
    <input type="text" name="alamat" class="form-control" required>
    <label>No HP</label>
    <input type="text" name="no_hp" class="form-control" required>
    <label>Email</label>
    <input type="email" name="email" class="form-control" required>
    <label>Password</label>
    <input type="password" name="password" class="form-control" required>
    <button type="submit" class="btn btn-success mt-3">Simpan</button>
</form>
@endsection
