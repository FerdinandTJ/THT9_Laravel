<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\Tagihan;
use App\Models\Cashflow;
use App\Models\RiwayatPembayaran;
use Illuminate\Support\Facades\Auth;

class PengurusController extends Controller
{
    /**
     * Dashboard Pengurus.
     */
    public function index()
    {
        return view('pengurus.index');
    }

    /**
     * Form Tambah Warga.
     */
    public function createWarga()
    {
        return view('pengurus.create-warga');
    }

    /**
     * Simpan Warga Baru.
     */
    public function storeWarga(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat_rumah' => 'required|string|max:500',
            'username' => 'required|string|unique:warga,username',
            'password' => 'required|string|min:6|confirmed',
        ]);

        Warga::create([
            'nama' => $request->nama,
            'alamat_rumah' => $request->alamat_rumah,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'perumahan_id' => auth()->user()->perumahan_id,
        ]);

        return redirect()->route('pengurus.index')->with('success', 'Warga berhasil ditambahkan!');
    }

    /**
     * Kelola Cashflow.
     */
    public function manageCashflow()
    {
        $cashflows = Cashflow::where('perumahan_id', auth()->user()->perumahan_id)->get();
        return view('pengurus.cashflow', compact('cashflows'));
    }

    /**
     * Tambah Cashflow.
     */
    public function storeCashflow(Request $request)
    {
        $request->validate([
            'type' => 'required|in:pemasukan,pengeluaran',
            'kategori' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:500',
        ]);

        Cashflow::create([
            'type' => $request->type,
            'kategori' => $request->kategori,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'perumahan_id' => auth()->user()->perumahan_id,
        ]);

        return redirect()->route('pengurus.cashflow')->with('success', 'Data cashflow berhasil ditambahkan!');
    }

    /**
     * Kelola Tagihan.
     */
    public function manageTagihan()
    {
        $tagihan = Tagihan::where('perumahan_id', auth()->user()->perumahan_id)->get();
        return view('pengurus.tagihan', compact('tagihan'));
    }

    /**
     * Tambah Tagihan Baru.
     */
    public function storeTagihan(Request $request)
    {
        $request->validate([
            'komponen' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
        ]);

        Tagihan::create([
            'komponen' => $request->komponen,
            'nominal' => $request->nominal,
            'perumahan_id' => auth()->user()->perumahan_id,
        ]);

        return redirect()->route('pengurus.tagihan')->with('success', 'Tagihan berhasil ditambahkan!');
    }

    /**
     * Konfirmasi Pembayaran Warga.
     */
    public function approvePayment($id)
    {
        $pembayaran = RiwayatPembayaran::findOrFail($id);
        $pembayaran->update(['status' => 'diterima']);

        return redirect()->back()->with('success', 'Pembayaran warga berhasil disetujui!');
    }

    /**
     * Tolak Pembayaran Warga.
     */
    public function rejectPayment($id)
    {
        $pembayaran = RiwayatPembayaran::findOrFail($id);
        $pembayaran->update(['status' => 'ditolak']);

        return redirect()->back()->with('success', 'Pembayaran warga berhasil ditolak!');
    }
}
