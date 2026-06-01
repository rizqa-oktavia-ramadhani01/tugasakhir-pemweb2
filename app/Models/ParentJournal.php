<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParentJournal extends Model
{
    protected $fillable = [
        'child_id',
        'tanggal',
        'aktivitas_dilakukan',
        'respon_anak',
        'kata_baru',
        'kendala',
        'catatan'
    ];

    public function child()
    {
        return $this->belongsTo(Children::class);
    }
}
