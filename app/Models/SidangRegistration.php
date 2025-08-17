<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SidangRegistration extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'judul_tugas_akhir', 'status_verifikasi', 'catatan_admin', 'pembimbing_id', 'periode_sidang_id', 'verifikasi_admin', 'verifikasi_kaprodi', 'catatan_kaprodi',];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function berkasSyarat()
    {
        return $this->hasMany(BerkasSyarat::class, 'sidang_registration_id');
    }

    public function sidangSchedule()
    {
        return $this->hasOne(SidangSchedule::class);
    }

    public function pembimbing()
    {
        return $this->belongsTo(User::class, 'pembimbing_id');
    }

    public function periode()
    {
        return $this->belongsTo(PeriodeSidang::class, 'periode_sidang_id');
    }

    public function values()
    {
        return $this->hasOneThrough(
            \App\Models\SidangValue::class, // nilai
            \App\Models\SidangSchedule::class, // jadwal
            'sidang_registration_id', // FK di sidang_schedules
            'sidang_schedule_id', // FK di sidang_values
            'id', // local key di sidang_registrations
            'id' // local key di sidang_schedules
        );
    }

    public function getStatusVerifikasiAkhirAttribute()
    {
        if ($this->verifikasi_admin === 'diterima' && $this->verifikasi_kaprodi === 'diterima') {
            return 'diterima';
        }

        if ($this->verifikasi_admin === 'ditolak' || $this->verifikasi_kaprodi === 'ditolak') {
            return 'ditolak';
        }

        return 'pending';
    }


}
