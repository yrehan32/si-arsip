<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipSuratModel extends Model
{
    use HasFactory;
    protected $table = 'arsip_surat';
    protected $fillable = [
        'nomor_surat',
        'kategori',
        'judul',
        'file_path',
    ];
}
