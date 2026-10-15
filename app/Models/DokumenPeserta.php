<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenPeserta extends Model
{
    protected $table = 'dokumen_peserta';

    protected $fillable = [
        'peserta_id',
        'ktp_path',
        'ijazah_path',
    ];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }
}

