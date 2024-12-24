<?php

namespace App\Http\Controllers;

use App\Models\Perumahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of all perumahan (pengurus perumahan).
     */
    public function index()
    {
        $perumahans = Perumahan::all();
        return view('admin.index', compact('perumahans'));
    }

    /**
     * Show the form for creating a new pengurus perumahan.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created pengurus perumahan in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_perumahan' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|unique:perumahan,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        Perumahan::create([
            'nama_perumahan' => $request->nama_perumahan,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.index')->with('success', 'Pengurus perumahan berhasil ditambahkan!');
    }

    /**
     * Show the form for editing an existing pengurus perumahan.
     */
    public function edit($id)
    {
        $perumahan = Perumahan::findOrFail($id);
        return view('admin.edit', compact('perumahan'));
    }

    /**
     * Update the specified pengurus perumahan in storage.
     */
    public function update(Request $request, $id)
    {
        $perumahan = Perumahan::findOrFail($id);

        $request->validate([
            'nama_perumahan' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'no_hp' => 'required|string|max:15',
            'email' => "required|email|unique:perumahan,email,{$id}",
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $perumahan->update([
            'nama_perumahan' => $request->nama_perumahan,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $perumahan->password,
        ]);

        return redirect()->route('admin.index')->with('success', 'Pengurus perumahan berhasil diperbarui!');
    }

    /**
     * Remove the specified pengurus perumahan from storage.
     */
    public function destroy($id)
    {
        $perumahan = Perumahan::findOrFail($id);
        $perumahan->delete();

        return redirect()->route('admin.index')->with('success', 'Pengurus perumahan berhasil dihapus!');
    }
}
