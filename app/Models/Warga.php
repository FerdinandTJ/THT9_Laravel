<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warga extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'alamat_rumah', 'username', 'password', 'perumahan_id'];

    public function riwayatPembayaran()
    {
        return $this->hasMany(RiwayatPembayaran::class);
    }
}
