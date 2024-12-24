<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cashflow;
use App\Models\Tagihan;
use App\Models\RiwayatPembayaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class WargaController extends Controller
{
    /**
     * Dashboard Warga.
     */
    public function index()
    {
        return view('warga.index');
    }

    /**
     * Melihat Cashflow.
     */
    public function viewCashflow()
    {
        $cashflows = Cashflow::where('perumahan_id', auth()->user()->perumahan_id)->get();
        return view('warga.cashflow', compact('cashflows'));
    }

    /**
     * Melihat Tagihan IPL.
     */
    public function viewTagihan()
    {
        $tagihan = Tagihan::where('perumahan_id', auth()->user()->perumahan_id)->get();
        return view('warga.tagihan', compact('tagihan'));
    }

    /**
     * Riwayat Pembayaran.
     */
    public function riwayatPembayaran()
    {
        $riwayat = RiwayatPembayaran::where('warga_id', auth()->id())->get();
        return view('warga.riwayat-pembayaran', compact('riwayat'));
    }

    /**
     * Upload Bukti Pembayaran.
     */
    public function uploadPayment(Request $request)
    {
        $request->validate([
            'tagihan_id' => 'required|exists:tagihan,id',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $buktiPath = $request->file('bukti_pembayaran')->store('uploads', 'public');

        RiwayatPembayaran::create([
            'warga_id' => auth()->id(),
            'tagihan_id' => $request->tagihan_id,
            'bukti_pembayaran' => $buktiPath,
            'status' => 'pending',
            'tanggal_bayar' => now(),
        ]);

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diunggah! Menunggu konfirmasi pengurus.');
    }

    /**
     * Mengubah Password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->back()->with('success', 'Password berhasil diubah!');
    }
}
