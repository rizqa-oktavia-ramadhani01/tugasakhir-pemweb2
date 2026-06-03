<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    protected $table = 'children';

    protected $fillable = [
        'user_id',
        'nama_anak',
        'usia_anak',
        'jenis_kelamin',
        'tingkat_kemampuan_bicara',
        'respon_verbal',
        'riwayat_perkembangan_bahasa'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dailyTodos()
    {
        return $this->hasMany(DailyTodo::class, 'child_id');
    }

    public function journals()
    {
        return $this->hasMany(ParentJournal::class, 'child_id');
    }

    public function childMilestones()
    {
        return $this->hasMany(ChildMilestone::class, 'child_id');
    }
}
