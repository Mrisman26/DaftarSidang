<?php

namespace App\Http\Controllers;

use App\Models\Enter;
use App\Models\Ruangan;
use App\Models\SidangRegistration;
use App\Models\SidangSchedule;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SidangScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user(); // Ambil pengguna yang sedang login

        // Ambil data mahasiswa (jika dibutuhkan di view)
        $mahasiswas = User::role('mahasiswa')->with('profile')->get();

        $jadwals = SidangSchedule::with([
            'sidangRegistration.user.profile',
            'pembimbing',
            'penguji1',
            'penguji2',
            'penguji3',
            'ruangan',
            'sidangRegistration.user.mahasiswaProfile'
        ])
        ->when($user->hasRole('Mahasiswa'), function ($query) use ($user) {
            // Mahasiswa hanya melihat jadwal dirinya
            $query->whereHas('sidangRegistration', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        })
        ->when($user->hasRole('Dosen'), function ($query) use ($user) {
            // Dosen melihat jadwal yang dia bimbing atau uji
            $query->where(function ($q) use ($user) {
                $q->where('pembimbing_id', $user->id)
                    ->orWhere('penguji_id_1', $user->id)
                    ->orWhere('penguji_id_2', $user->id)
                    ->orWhere('penguji_id_3', $user->id);

            });
        })
        ->when($user->hasRole('Kaprodi'), function ($query) use ($user) {
            // Kaprodi hanya melihat jadwal sidang mahasiswa dari prodi mereka
            $query->whereHas('sidangRegistration.user.mahasiswaProfile', function ($q) use ($user) {
                $q->where('prodi_id', $user->dosenProfile->prodi_id ?? null);
            });
        })
        // Admin melihat semua data, tidak perlu filter
        ->latest()
        ->get();

        return view('sidang_schedules.index', compact('jadwals', 'mahasiswas'));
    }

    public function create()
    {
        $user = auth()->user();

        $ruangans = Ruangan::all();

        // Ambil prodi_id dari kaprodi (jika login sebagai kaprodi)
        $prodiId = null;
        if ($user->hasRole('Kaprodi')) {
            $prodiId = $user->dosenProfile->prodi_id ?? null;
        }

        // Ambil pendaftar yang diverifikasi dan belum punya jadwal
        $pendaftar = SidangRegistration::with(['user', 'user.mahasiswaProfile'])
            ->where('verifikasi_admin', 'diterima')
            ->where('verifikasi_kaprodi', 'diterima')
            ->doesntHave('sidangSchedule')
            ->when($prodiId, function ($query) use ($prodiId) {
                $query->whereHas('user.mahasiswaProfile', function ($q) use ($prodiId) {
                    $q->where('prodi_id', $prodiId);
                });
            })
            ->get();

        // Ambil dosen penguji dari prodi yang sama
        $pengujis = User::whereHas('dosenProfile', function ($query) use ($prodiId) {
            $query->where('is_penguji', true);
            if ($prodiId) {
                $query->where('prodi_id', $prodiId);
            }
        })->get();

        return view('sidang_schedules.create', compact('pendaftar', 'pengujis', 'ruangans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sidang_registration_id' => 'required|exists:sidang_registrations,id',
            'tanggal_sidang' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'penguji_id_1' => 'required|exists:users,id',
            'penguji_id_2' => 'nullable|exists:users,id|different:penguji_id_1',
            'penguji_id_3' => 'nullable|exists:users,id|different:penguji_id_1|different:penguji_id_2',
            'ruangan_id' => 'required|exists:ruangans,id',
        ]);

        $pendaftaran = SidangRegistration::with('pembimbing')->findOrFail($request->sidang_registration_id);

        SidangSchedule::create([
            'sidang_registration_id' => $pendaftaran->id,
            'tanggal_sidang' => $request->tanggal_sidang,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'pembimbing_id' => $pendaftaran->pembimbing_id,
            'penguji_id_1' => $request->penguji_id_1,
            'penguji_id_2' => $request->penguji_id_2,
            'penguji_id_3' => $request->penguji_id_3,
            'ruangan_id' => $request->ruangan_id,
        ]);

        return redirect()->route('sidang-schedules.index')->with('success', 'Jadwal sidang berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $jadwalSidang = SidangSchedule::with([
            'pembimbing.dosenProfile'
        ])->findOrFail($id);

        return view('sidang_schedules.show', compact('jadwalSidang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SidangSchedule $jadwal_sidang)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SidangSchedule $sidangSchedule)
    {
        $sidangSchedule->delete();
        return redirect()->back()->with('success', 'Jadwal sidang berhasil dihapus.');
    }

    public function printDaftarHadir(SidangSchedule $sidangSchedule)
    {
        $sidangSchedule->load([
            'sidangRegistration.user',
            'ruangan',
            'pembimbing',
            'penguji1',
            'penguji2',
            'penguji3'
        ]);

        $mahasiswa = $sidangSchedule->sidangRegistration->user ?? null;

        return Pdf::loadView('sidang_schedules.daftar_hadir_pdf', compact(
            'sidangSchedule', 'mahasiswa'
        ))->stream('daftar-hadir-sidang.pdf');
    }

    public function cetakBeritaAcara(SidangSchedule $sidangSchedule)
    {
        $sidangSchedule->load([
            'sidangRegistration.user', // untuk prodi
            'ruangan',
            'pembimbing',
            'penguji1',
            'penguji2',
            'penguji3'
        ]);

        $mahasiswa = $sidangSchedule->sidangRegistration->user ?? null;

        return Pdf::loadView('sidang_schedules.cetak_berita_acara', compact(
            'sidangSchedule', 'mahasiswa'
        ))->stream('cetak_berita_acara');
    }



}
