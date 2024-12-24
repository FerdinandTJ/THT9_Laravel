<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPembayaran extends Model
{
    use HasFactory;

    protected $fillable = ['warga_id', 'tagihan_id', 'status', 'bukti_pembayaran', 'tanggal_bayar'];
}
