<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChildMilestone extends Model
{
    protected $fillable = [
        'child_id',
        'milestone_id',
        'status'
    ];

    public function child()
    {
        return $this->belongsTo(Children::class);
    }

    public function milestone()
    {
        return $this->belongsTo(Milestone::class);
    }
}
