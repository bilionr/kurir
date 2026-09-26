<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kurir extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'no_telp',
        'plat_kendaraan',
        'level',
    ];
}
