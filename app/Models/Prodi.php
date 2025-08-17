<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Prodi extends Model
{
    use HasFactory;
    protected $fillable = ['nama_prodi', 'jenjang'];

    // Relasi ke MahasiswaProfile
    public function mahasiswaProfiles()
    {
        return $this->hasMany(MahasiswaProfile::class);
    }

    // Relasi ke DosenProfile
    public function dosenProfiles()
    {
        return $this->hasMany(DosenProfile::class);
    }

    public function periodeSidangs()
    {
        return $this->hasMany(PeriodeSidang::class);
    }

}
