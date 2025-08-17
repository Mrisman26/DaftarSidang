<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SidangSchedule extends Model
{
    use HasFactory;
    protected $fillable = ['sidang_registration_id', 'tanggal_sidang', 'ruangan_id', 'pembimbing_id', 'penguji_id_1', 'penguji_id_2', 'penguji_id_3', 'jam_mulai', 'jam_selesai'];

    public function sidangRegistration()
    {
        return $this->belongsTo(SidangRegistration::class);
    }

    public function pembimbing()
    {
        return $this->belongsTo(User::class, 'pembimbing_id');
    }

    public function penguji1()
    {
        return $this->belongsTo(User::class, 'penguji_id_1');
    }

    public function penguji2()
    {
        return $this->belongsTo(User::class, 'penguji_id_2');
    }

    public function penguji3()
    {
        return $this->belongsTo(User::class, 'penguji_id_3');
    }

    public function values()
    {
        return $this->hasMany(SidangValue::class, 'sidang_schedule_id');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }
}
