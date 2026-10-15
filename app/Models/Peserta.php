<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\DokumenPeserta;

class Peserta extends Model
{

    protected $table = 'pesertas';


    protected $fillable = [
        'user_id',
        'skema_id',
        'nama_peserta',
        'alamat',
        'no_hp',
        'email',
    ];

  public function skema()
    {
        return $this->belongsTo(SkemaSertifikasi::class, 'skema_id');
    }
    public function dokumen()
{
    return $this->hasOne(DokumenPeserta::class);
}
}
