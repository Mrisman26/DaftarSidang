<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodeSidang extends Model
{

    protected $fillable = [ 'prodi_id', 'nama_periode', 'tanggal_mulai', 'tanggal_selesai', 'is_aktif',''];

    public static function periode()
    {
        return self::where('is_aktif', true)->first();
    }


    public function sidangRegistration()
    {
        return $this->hasMany(SidangRegistration::class, 'periode_sidang_id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
}
