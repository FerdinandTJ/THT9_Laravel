<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Import HasFactory
use Illuminate\Database\Eloquent\Model;

class Perumahan extends Model
{
    use HasFactory;

    protected $fillable = ['nama_perumahan', 'alamat', 'no_hp', 'email', 'password'];

    public function warga()
    {
        return $this->hasMany(Warga::class);
    }
}
