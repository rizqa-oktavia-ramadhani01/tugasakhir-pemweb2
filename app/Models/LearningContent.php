<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LearningContent extends Model
{
    protected $fillable = [
        'judul',
        'kategori',
        'deskripsi',
        'isi',
        'gambar',
        'audio'
    ];
}
