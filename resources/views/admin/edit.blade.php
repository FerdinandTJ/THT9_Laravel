@extends('layouts.app')

@section('content')
<h1>Edit Pengurus Perumahan</h1>

<form action="{{ route('admin.update', $perumahan->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nama Perumahan</label>
    <input type="text" name="nama_perumahan" class="form-control" value="{{ $perumahan->nama_perumahan }}" required>

    <label>Alamat</label>
    <input type="text" name="alamat" class="form-control" value="{{ $perumahan->alamat }}" required>

    <label>No HP</label>
    <input type="text" name="no_hp" class="form-control" value="{{ $perumahan->no_hp }}" required>

    <label>Email</label>
    <input type="email" name="email" class="form-control" value="{{ $perumahan->email }}" required>

    <label>Password (Kosongkan jika tidak ingin mengubah)</label>
    <input type="password" name="password" class="form-control">

    <label>Konfirmasi Password</label>
    <input type="password" name="password_confirmation" class="form-control">

    <button type="submit" class="btn btn-success mt-3">Perbarui</button>
</form>
@endsection
