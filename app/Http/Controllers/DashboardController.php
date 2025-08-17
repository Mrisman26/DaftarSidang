<?php

namespace App\Http\Controllers;

use App\Models\SidangRegistration;
use App\Models\SidangSchedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('Admin') || $user->hasRole('Kaprodi')) {
            $prodiId = null;
            $verifikasiField = null;

            if ($user->hasRole('Admin')) {
                $verifikasiField = 'verifikasi_admin';
            } elseif ($user->hasRole('Kaprodi')) {
                $verifikasiField = 'verifikasi_kaprodi';
                $prodiId = $user->dosenProfile->prodi_id ?? null;
            }

            // Total Mahasiswa (jika kaprodi, filter berdasarkan prodi)
            $totalMahasiswa = User::role('Mahasiswa')
                ->when($prodiId, function ($query) use ($prodiId) {
                    return $query->whereHas('mahasiswaProfile', function ($q) use ($prodiId) {
                        $q->where('prodi_id', $prodiId);
                    });
                })->count();

            // Total Mendaftar
            $sidangQuery = SidangRegistration::when($prodiId, function ($query) use ($prodiId) {
                return $query->whereHas('user.mahasiswaProfile', function ($q) use ($prodiId) {
                    $q->where('prodi_id', $prodiId);
                });
            });

            $totalMendaftar = (clone $sidangQuery)->count();

            $sidangDiterima = (clone $sidangQuery)->where($verifikasiField, 'diterima')->count();
            $sidangDitolak  = (clone $sidangQuery)->where($verifikasiField, 'ditolak')->count();
            $sidangPending  = (clone $sidangQuery)->where($verifikasiField, 'pending')->count();

            return view('dashboard.admin', compact(
                'totalMahasiswa',
                'totalMendaftar',
                'sidangDiterima',
                'sidangDitolak',
                'sidangPending'
            ));
        }

        // DOSEN
        if ($user->hasRole('Dosen')) {
            $prodiId = $user->dosenProfile->prodi_id;

            $totalMahasiswa = User::role('Mahasiswa')
                ->whereHas('mahasiswaProfile', function ($query) use ($prodiId) {
                    $query->where('prodi_id', $prodiId);
                })->count();

            $sidangProdiQuery = SidangRegistration::whereHas('user.mahasiswaProfile', function ($query) use ($prodiId) {
                $query->where('prodi_id', $prodiId);
            });

            $totalMendaftar = (clone $sidangProdiQuery)->count();

            $sidangDiterima = (clone $sidangProdiQuery)
                ->where('verifikasi_admin', 'diterima')
                ->where('verifikasi_kaprodi', 'diterima')
                ->count();

            $sidangDitolak = (clone $sidangProdiQuery)
                ->where(function ($q) {
                    $q->where('verifikasi_admin', 'ditolak')
                    ->orWhere('verifikasi_kaprodi', 'ditolak');
                })->count();

            $sidangPending = (clone $sidangProdiQuery)
                ->where(function ($q) {
                    $q->where('verifikasi_admin', 'pending')
                    ->orWhere('verifikasi_kaprodi', 'pending');
                })
                ->where(function ($q) {
                    $q->where('verifikasi_admin', '!=', 'ditolak')
                    ->where('verifikasi_kaprodi', '!=', 'ditolak');
                })->count();

            $jadwals = SidangSchedule::with([
                'sidangRegistration.user.profile',
                'pembimbing',
                'penguji1',
                'penguji2',
                'penguji3',

            ])
            ->whereHas('sidangRegistration.user.mahasiswaProfile', function ($query) use ($prodiId) {
                $query->where('prodi_id', $prodiId);
            })
            ->where(function ($query) use ($user) {
                $query->where('pembimbing_id', $user->id)
                    ->orWhere('penguji_id_1', $user->id)
                    ->orWhere('penguji_id_2', $user->id)
                    ->orWhere('penguji_id_3', $user->id);
            })
            ->latest()
            ->get();

            return view('dashboard.admin', compact(
                'totalMahasiswa',
                'totalMendaftar',
                'sidangDiterima',
                'sidangDitolak',
                'sidangPending',
                'jadwals'
            ));
        }

        // MAHASISWA
        if ($user->hasRole('Mahasiswa')) {
            $user->load('mahasiswaProfile.prodi');

            $sidangRegistration = $user->sidangRegistrations()->latest()->first();
            if ($sidangRegistration) {
               $sidangRegistration->load('sidangSchedule.pembimbing', 'sidangSchedule.penguji1', 'sidangSchedule.penguji2', 'sidangSchedule.penguji3');

            }

            return view('dashboard.mahasiswa', compact('user', 'sidangRegistration'));
        }

        // Role tidak dikenali
        abort(403, 'Unauthorized');
    }

}
