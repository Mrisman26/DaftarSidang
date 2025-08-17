<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasSyarat extends Model
{
    use HasFactory;
    protected $fillable = ['sidang_registration_id', 'jenis_berkas', 'file_path'];

    public function sidangRegistration()
    {
        return $this->belongsTo(SidangRegistration::class);
    }
}
