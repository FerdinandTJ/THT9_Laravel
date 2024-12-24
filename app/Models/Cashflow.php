<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cashflow extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'kategori', 'jumlah', 'keterangan', 'perumahan_id'];
}
