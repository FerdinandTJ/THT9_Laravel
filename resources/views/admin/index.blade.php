@extends('layouts.app')

@section('content')
<h1>Daftar Pengurus Perumahan</h1>
<a href="{{ route('admin.create') }}" class="btn btn-primary">Tambah Pengurus</a>

<table class="table table-striped mt-4">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Perumahan</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($perumahan as $Perumahan)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $perumahan->nama_perumahan }}</td>
            <td>{{ $perumahan->email }}</td>
            <td>{{ $perumahan->no_hp }}</td>
            <td>
                <a href="{{ route('admin.edit', $perumahan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.destroy', $perumahan->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
