<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'judul',
        'kategori',
        'durasi_menit',
        'deskripsi',
        'panduan'
    ];

    public function dailyTodos()
    {
        return $this->hasMany(DailyTodo::class);
    }
}
