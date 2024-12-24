<?php

namespace App\Http\Controllers;

use App\Models\Perumahan;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PerumahanController extends Controller
{
    /**
     * Display a listing of perumahan.
     */
    public function index()
    {
        $perumahans = Perumahan::all();
        return view('perumahan.index', compact('perumahans'));
    }

    /**
     * Show the form for creating a new perumahan.
     */
    public function create()
    {
        return view('perumahan.create');
    }

    /**
     * Store a newly created perumahan in storage.
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

        return redirect()->route('perumahan.index')->with('success', 'Perumahan berhasil ditambahkan!');
    }

    /**
     * Display the specified perumahan.
     */
    public function show($id)
    {
        $perumahan = Perumahan::with('warga')->findOrFail($id);
        return view('perumahan.show', compact('perumahan'));
    }

    /**
     * Show the form for editing the specified perumahan.
     */
    public function edit($id)
    {
        $perumahan = Perumahan::findOrFail($id);
        return view('perumahan.edit', compact('perumahan'));
    }

    /**
     * Update the specified perumahan in storage.
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

        return redirect()->route('perumahan.index')->with('success', 'Perumahan berhasil diperbarui!');
    }

    /**
     * Remove the specified perumahan from storage.
     */
    public function destroy($id)
    {
        $perumahan = Perumahan::findOrFail($id);
        $perumahan->delete();

        return redirect()->route('perumahan.index')->with('success', 'Perumahan berhasil dihapus!');
    }

    /**
     * Add warga to perumahan.
     */
    public function addWarga(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat_rumah' => 'required|string|max:500',
            'username' => 'required|string|unique:warga,username',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $perumahan = Perumahan::findOrFail($id);

        $perumahan->warga()->create([
            'nama' => $request->nama,
            'alamat_rumah' => $request->alamat_rumah,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('perumahan.show', $id)->with('success', 'Warga berhasil ditambahkan!');
    }

    /**
     * Remove warga from perumahan.
     */
    public function removeWarga($perumahan_id, $warga_id)
    {
        $warga = Warga::where('perumahan_id', $perumahan_id)->findOrFail($warga_id);
        $warga->delete();

        return redirect()->route('perumahan.show', $perumahan_id)->with('success', 'Warga berhasil dihapus!');
    }
}
