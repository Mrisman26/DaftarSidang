<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SidangValue extends Model
{
    use HasFactory;
    protected $fillable = ['sidang_schedule_id', 'penguji_id', 'nilai', 'komentar'];

    public function sidangSchedule()
    {
        return $this->belongsTo(SidangSchedule::class, 'sidang_schedule_id');
    }

    public function penguji()
    {
        return $this->belongsTo(User::class, 'penguji_id');
    }
}
