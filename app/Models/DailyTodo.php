<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyTodo extends Model
{
    protected $fillable = [
        'child_id',
        'activity_id',
        'tanggal',
        'status'
    ];

    public function child()
    {
        return $this->belongsTo(Children::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
