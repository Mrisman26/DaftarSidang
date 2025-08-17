<?php

namespace App\Http\Controllers;

use App\Models\BerkasSyarat;
use App\Models\PeriodeSidang;
use App\Models\Profile;
use App\Models\SidangRegistration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SidangRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        // ===== Mahasiswa: hanya melihat miliknya =====
        if ($user->hasRole('Mahasiswa')) {
            $sidangRegistrations = SidangRegistration::with([
                'sidangSchedule.pembimbing',
                'sidangSchedule.penguji1',
                'sidangSchedule.penguji2',
                'sidangSchedule.penguji3',
                'sidangSchedule.values',
                'values'
            ])
            ->where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->get();

        // ===== Kaprodi: hanya melihat pendaftar dari prodi-nya =====
        } elseif ($user->hasRole('Kaprodi')) {
            $prodiId = $user->dosenProfile->prodi_id ?? null;

            $sidangRegistrations = SidangRegistration::with([
                'user.mahasiswaProfile',
                'sidangSchedule.pembimbing',
                'sidangSchedule.penguji1',
                'sidangSchedule.penguji2',
                'sidangSchedule.penguji3',
                'sidangSchedule.values'
            ])
            ->whereHas('user.mahasiswaProfile', function ($query) use ($prodiId) {
                $query->where('prodi_id', $prodiId);
            })
            ->orderByDesc('created_at')
            ->get();

        // ===== Dosen: hanya melihat sidang di mana dia sebagai penguji =====
        } elseif ($user->hasRole('Dosen')) {
            $sidangRegistrations = SidangRegistration::with([
                'user.mahasiswaProfile',
                'sidangSchedule' => function ($query) use ($user) {
                    $query->where('penguji_id', $user->id);
                },
                'sidangSchedule.pembimbing',
                'sidangSchedule.values'
            ])
            ->whereHas('sidangSchedule', function ($query) use ($user) {
                $query->where('penguji_id', $user->id);
            })
            ->orderByDesc('created_at')
            ->get();

        // ===== Admin & lainnya: tampilkan semua =====
        } else {
            $sidangRegistrations = SidangRegistration::with([
                'user.mahasiswaProfile',
                'sidangSchedule.pembimbing',
                'sidangSchedule.penguji1',
                'sidangSchedule.penguji2',
                'sidangSchedule.penguji3',
                'sidangSchedule.values'
            ])
            ->orderByDesc('created_at')
            ->get();
        }

        return view('sidang_registrations.index', compact('sidangRegistrations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();

        // Ambil prodi_id dari user yang login
        $prodiId = null;
        if ($user->hasRole('Mahasiswa')) {
            $prodiId = optional($user->mahasiswaProfile)->prodi_id;
        } elseif ($user->hasRole('Dosen')) {
            $prodiId = optional($user->dosenProfile)->prodi_id;
        }

        if (!$prodiId) {
            return redirect()->route('dashboard')->with('error', 'Prodi tidak ditemukan untuk pengguna ini.');
        }

        // Ambil periode sidang yang aktif untuk prodi ini
        $periode = PeriodeSidang::where('prodi_id', $prodiId)
            ->where('is_aktif', 'Aktif')
            ->first();

        if (!$periode) {
            return redirect()->route('dashboard')->with('error', 'Tidak ada periode sidang aktif untuk program studi Anda.');
        }

        // Ambil dosen pembimbing di prodi yang sama
        $dosen = User::whereHas('roles', function ($query) {
                $query->whereIn('name', ['Dosen', 'Kaprodi']);
            })
            ->whereHas('dosenProfile', function ($query) use ($prodiId) {
                $query->where('prodi_id', $prodiId)
                    ->where('is_pembimbing', true);
            })
            ->with('dosenProfile.prodi')
            ->get();


        return view('sidang_registrations.create', compact('dosen', 'periode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $periode = PeriodeSidang::where('is_aktif', 'Aktif')->first();

        if (!$periode) {
            return back()->with('error', 'Tidak ada periode sidang yang aktif saat ini.');
        }

        $request->validate([
            'judul_tugas_akhir' => 'required|string|max:255',
            'pembimbing_id' => 'required|exists:users,id',
            'proposal' => 'required|mimes:pdf|max:2048',
            'transkrip' => 'required|mimes:pdf|max:2048',
            'kartu_bimbingan' => 'required|mimes:pdf|max:2048',
        ]);

        // Simpan data pendaftaran sidang
        $sidang = SidangRegistration::create([
            'user_id' => auth()->id(),
            'judul_tugas_akhir' => $request->input('judul_tugas_akhir'),
            'pembimbing_id' => $request->input('pembimbing_id'),
            'periode_sidang_id' => $periode->id,
            'status_admin' => 'pending', // Nilai default
            'status_kaprodi' => 'pending', // Nilai default
            'catatan_admin' => null, // Kosong saat pendaftaran awal
            'catatan_kaprodi' => null, // Kosong saat pendaftaran awal
        ]);

        // Upload berkas
        $berkas = [
            'proposal' => $request->file('proposal'),
            'transkrip' => $request->file('transkrip'),
            'kartu_bimbingan' => $request->file('kartu_bimbingan'),
        ];

        foreach ($berkas as $jenis => $file) {
            if ($file) {
                // Simpan di storage/app/public/berkas_sidang pakai nama asli
                $file->storeAs('berkas_sidang', $file->getClientOriginalName(), 'public');

                // Simpan path relatif ke DB
                BerkasSyarat::create([
                    'sidang_registration_id' => $sidang->id,
                    'jenis_berkas' => $jenis,
                    'file_path' => 'berkas_sidang/' . $file->getClientOriginalName(),
                ]);
            }
        }

        return redirect()->route('sidang-registrations.index')->with('success', 'Pendaftaran sidang berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SidangRegistration $sidangRegistration)
    {
        // Memuat relasi sidangSchedule beserta pembimbing dan penguji
        $sidangRegistration->load('pembimbing', 'sidangSchedule.pembimbing', 'sidangSchedule.penguji1',
        'sidangSchedule.penguji2', 'sidangSchedule.penguji3', 'pembimbing.dosenProfile',);

        return view('sidang_registrations.show', compact('sidangRegistration'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SidangRegistration $sidangRegistration)
    {
        $user = auth()->user();

        // Ambil prodi_id sesuai role
        $prodi_id = null;

        if ($user->hasRole('Mahasiswa')) {
            $prodi_id = optional($user->mahasiswaProfile)->prodi_id;
        } elseif ($user->hasRole('Dosen')) {
            $prodi_id = optional($user->dosenProfile)->prodi_id;
        }

        // Cek apakah yang sedang mengakses adalah mahasiswa yang memiliki sidang tersebut
        if ($sidangRegistration->user_id != auth()->id()) {
            return redirect()->route('sidang-registrations.index')->with('error', 'Anda tidak memiliki akses ke pendaftaran ini.');
        }

        // Ambil dosen sesuai prodi (cari dari dosen_profiles)
        $dosen = User::role('Dosen')
            ->whereHas('dosenProfile', function ($query) use ($prodi_id) {
                $query->where('prodi_id', $prodi_id);
            })
            ->with('dosenProfile.prodi')
            ->get();

        // Memastikan relasi berkasSyarat sudah diload
        $sidangRegistration->load('berkasSyarat');

        // Jika kamu punya daftar jenis berkas yang wajib di form, ambil juga (opsional)
        $jenisBerkas = ['proposal', 'laporan', 'kartu_bimbingan'];

        return view('sidang_registrations.edit', compact('sidangRegistration', 'jenisBerkas', 'dosen'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SidangRegistration $sidangRegistration)
    {

        // Validasi input
        $request->validate([
            'judul_tugas_akhir' => 'required|string|max:255',
            'proposal' => 'nullable|mimes:pdf|max:2048',
            'transkrip' => 'nullable|mimes:pdf|max:2048',
            'kartu_bimbingan' => 'nullable|mimes:pdf|max:2048',
            'pembimbing_id' => 'required|exists:users,id',
        ]);

        // Update judul tugas akhir
        $sidangRegistration->update([
            'judul_tugas_akhir' => $request->input('judul_tugas_akhir'),
            'pembimbing_id' => $request->input('pembimbing_id'),
        ]);

        // Proses upload file baru jika ada
        $berkas = [
            'proposal' => $request->file('proposal'),
            'transkrip' => $request->file('transkrip'),
            'kartu_bimbingan' => $request->file('kartu_bimbingan'),
        ];

        foreach ($berkas as $jenis => $file) {
            if ($file) {
                // Hapus berkas lama jika ada
                $oldBerkas = BerkasSyarat::where('sidang_registration_id', $sidangRegistration->id)
                                         ->where('jenis_berkas', $jenis)
                                         ->first();
                if ($oldBerkas) {
                    Storage::delete('public/' . $oldBerkas->file_path);
                    $oldBerkas->delete();
                }

                // Simpan berkas baru
                $file->storeAs('berkas_sidang', $file->getClientOriginalName(), 'public');

                BerkasSyarat::create([
                    'sidang_registration_id' => $sidangRegistration->id,
                    'jenis_berkas' => $jenis,
                    'file_path' => 'berkas_sidang/' . $file->getClientOriginalName(),
                ]);
            }
        }

        return redirect()->route('sidang-registrations.index')->with('success', 'Pendaftaran sidang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SidangRegistration $sidangRegistration)
    {
        // Menghapus Sidang Registration
        $sidangRegistration->delete();
        return redirect()->route('sidang-registrations.index')->with('success', 'Data berhasil dihapus.');
    }

    /**
     * Show the form for editing the specified resource.
    */
    public function verifikasi(SidangRegistration $sidangRegistration)
    {
        // Pakai eager load user.mahasiswaProfile atau user.dosenProfile
        $sidangRegistration->load(['user.mahasiswaProfile', 'user.dosenProfile', 'berkasSyarat', 'pembimbing', 'periode']);

        $berkas = $sidangRegistration->berkasSyarat ?? collect();
        $sidangSchedule = $sidangRegistration->sidangSchedule;

        // Ambil prodi_id mahasiswa pendaftar berdasarkan role
        $prodi_id = null;

        // Ambil prodi_id sesuai role mahasiswa atau dosen
        if ($sidangRegistration->user->hasRole('Mahasiswa')) {
            $prodi_id = optional($sidangRegistration->user->mahasiswaProfile)->prodi_id;
        } elseif ($sidangRegistration->user->hasRole('Dosen')) {
            $prodi_id = optional($sidangRegistration->user->dosenProfile)->prodi_id;
        }

        // Ambil dosen (user yang punya role 'Dosen') sesuai prodi mahasiswa
        $dosen = User::role('Dosen')
                    ->whereHas('dosenProfile', function ($query) use ($prodi_id) {
                        $query->where('prodi_id', $prodi_id);
                    })
                    ->with('dosenProfile')  // Gunakan dosenProfile
                    ->get();

        $startDate = optional($sidangRegistration->periode)->tanggal_mulai;
        $endDate = optional($sidangRegistration->periode)->tanggal_selesai;

        // Menampilkan form untuk mengedit Sidang Registration
        return view('sidang_registrations.verifikasi', compact('sidangRegistration', 'dosen', 'berkas', 'sidangSchedule', 'startDate', 'endDate'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function updateverifikasi(Request $request, SidangRegistration $sidangRegistration)
    // {

    //     // Validasi
    //     $request->validate([
    //         'status_verifikasi' => 'required|in:pending,diterima,ditolak',
    //         'catatan_admin' => 'required|string',
    //         'pembimbing_id' => 'required_if:status_verifikasi,diterima|nullable',
    //         'penguji_id' => 'required_if:status_verifikasi,diterima|nullable',
    //         'tanggal_sidang' => 'required_if:status_verifikasi,diterima|nullable|date',
    //         'ruangan' => 'required_if:status_verifikasi,diterima|nullable|string',
    //         'jam_mulai' => 'required_if:status_verifikasi,diterima|nullable|date_format:H:i',
    //         'jam_selesai' => 'required_if:status_verifikasi,diterima|nullable|date_format:H:i|after:jam_mulai',

    //     ]);

    //     // Update status_verifikasi di tabel sidang_registrations
    //     $sidangRegistration->update([
    //         'status_verifikasi' => $request->status_verifikasi,
    //         'catatan_admin' => $request->catatan_admin,
    //     ]);

    //     // Jika status verifikasi diterima
    //     if ($request->status_verifikasi === 'diterima') {

    //         $periode = $sidangRegistration->periode;
    //         if ($periode) {
    //             $request->validate([
    //                 'tanggal_sidang' => [
    //                     'required',
    //                     'date',
    //                     'after_or_equal:' . $periode->tanggal_mulai,
    //                     'before_or_equal:' . $periode->tanggal_selesai,
    //                 ],
    //             ]);
    //         }

    //         // Buat atau update SidangSchedule
    //         $sidangRegistration->sidangSchedule()->updateOrCreate(
    //             ['sidang_registration_id' => $sidangRegistration->id],
    //             [
    //                 'tanggal_sidang' => $request->tanggal_sidang,
    //                 'ruangan' => $request->ruangan,
    //                 'pembimbing_id' => $request->pembimbing_id,
    //                 'penguji_id' => $request->penguji_id,
    //                 'jam_mulai' => $request->jam_mulai,
    //                 'jam_selesai' => $request->jam_selesai,
    //             ]
    //         );
    //     } elseif ($request->status_verifikasi === 'ditolak') {
    //         // Hapus jadwal sidang jika ada
    //         if ($sidangRegistration->sidangSchedule) {
    //             $sidangRegistration->sidangSchedule->delete();
    //         }
    //     }

    //     return redirect()->route('sidang-registrations.index')->with('success', 'Data berhasil diperbarui.');
    // }

    public function verifikasiAdmin(SidangRegistration $sidangRegistration)
    {
        $sidangRegistration->load(['user.mahasiswaProfile', 'berkasSyarat', 'pembimbing', 'periode',]);

        $berkas = $sidangRegistration->berkasSyarat ?? collect();
        $prodi_id = optional($sidangRegistration->user->mahasiswaProfile)->prodi_id;

        $dosen = User::role('Dosen')
            ->whereHas('dosenProfile', fn($q) => $q->where('prodi_id', $prodi_id))
            ->get();

        // Menampilkan form untuk mengedit Sidang Registration
        return view('sidang_registrations.verifikasi-admin', compact('sidangRegistration', 'dosen', 'berkas'));
    }

    public function updateVerifikasiAdmin(Request $request, SidangRegistration $sidangRegistration)
    {
        $request->validate([
            'verifikasi_admin' => 'required|in:diterima,ditolak,pending',
            // 'catatan_admin' => 'required|string',
        ]);

        $sidangRegistration->update([
            'verifikasi_admin' => $request->verifikasi_admin,
            'catatan_admin' => $request->catatan_admin,
        ]);

        return redirect()->route('sidang-registrations.index')->with('success', 'Verifikasi Admin berhasil disimpan.');
    }

    public function verifikasiKaprodi(SidangRegistration $sidangRegistration)
    {
        $sidangRegistration->load(['user.mahasiswaProfile', 'berkasSyarat', 'pembimbing', 'periode', 'sidangSchedule']);

        $prodi_id = optional($sidangRegistration->user->mahasiswaProfile)->prodi_id;

        $dosen = User::role('Dosen')
            ->whereHas('dosenProfile', fn($q) => $q->where('prodi_id', $prodi_id))
            ->get();

        return view('sidang_registrations.verifikasi-kaprodi', [
            'sidangRegistration' => $sidangRegistration,
            'dosen' => $dosen,
            'berkas' => $sidangRegistration->berkasSyarat,
            'sidangSchedule' => $sidangRegistration->sidangSchedule,
            'startDate' => optional($sidangRegistration->periode)->tanggal_mulai,
            'endDate' => optional($sidangRegistration->periode)->tanggal_selesai,
        ]);
    }

    public function updateVerifikasiKaprodi(Request $request, SidangRegistration $sidangRegistration)
    {
        $request->validate([
            'verifikasi_kaprodi' => 'required|in:diterima,ditolak,pending',
            // 'catatan_kaprodi' => 'required|string',
        ]);

        $sidangRegistration->update([
            'verifikasi_kaprodi' => $request->verifikasi_kaprodi,
            'catatan_kaprodi' => $request->catatan_kaprodi,
        ]);

        return redirect()->route('sidang-registrations.index')->with('success', 'Verifikasi Kaprodi berhasil disimpan.');
    }


}
