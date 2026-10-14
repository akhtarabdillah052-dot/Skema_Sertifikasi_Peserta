<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
