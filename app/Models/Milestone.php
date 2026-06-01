<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    protected $fillable = [
        'kategori_usia',
        'milestone',
        'deskripsi'
    ];

    public function childMilestones()
    {
        return $this->hasMany(ChildMilestone::class);
    }
}
