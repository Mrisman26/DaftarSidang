<?php

namespace App\Http\Controllers;

use App\Models\SidangSchedule;
use App\Models\SidangValue;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SidangValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id(); // Dosen login

        // Ambil semua nilai sidang yang diberikan oleh dosen ini
        $sidangValues = SidangValue::with([
            'sidangSchedule.sidangRegistration.user',
            'sidangSchedule.penguji1',
            'sidangSchedule.penguji2',
            'sidangSchedule.penguji3',
        ])->where('penguji_id', $userId)->get();

        return view('sidang_values.index', compact('sidangValues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pengujiId = Auth::id();

        // Ambil semua jadwal sidang yang melibatkan dosen login sebagai salah satu penguji
        $jadwalSidangs = SidangSchedule::with(['pembimbing', 'penguji1', 'penguji2', 'penguji3'])
            ->where(function ($query) use ($pengujiId) {
                $query->where('penguji_id_1', $pengujiId)
                    ->orWhere('penguji_id_2', $pengujiId)
                    ->orWhere('penguji_id_3', $pengujiId);
            })
            ->get();

        return view('sidang_values.create', compact('jadwalSidangs'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sidang_schedule_id' => 'required|exists:sidang_schedules,id',
            'nilai' => 'required|integer|min:0|max:100',
            'komentar' => 'nullable|string|max:255',
        ]);

        $jadwal = SidangSchedule::findOrFail($request->sidang_schedule_id);
        $pengujiId = Auth::id();

        // Validasi bahwa dosen login adalah salah satu penguji
        if (!in_array($pengujiId, [$jadwal->penguji_id_1, $jadwal->penguji_id_2, $jadwal->penguji_id_3])) {
            return back()->withErrors(['error' => 'Anda bukan penguji untuk sidang ini.']);
        }

        // Cek apakah nilai sudah diberikan oleh penguji ini
        $existing = SidangValue::where('sidang_schedule_id', $jadwal->id)
            ->where('penguji_id', $pengujiId)
            ->exists();

        if ($existing) {
            return back()->withErrors(['error' => 'Anda sudah memberikan nilai untuk sidang ini.']);
        }

        // Simpan nilai
        SidangValue::create([
            'sidang_schedule_id' => $jadwal->id,
            'penguji_id' => $pengujiId,
            'nilai' => $request->nilai,
            'komentar' => $request->komentar,
        ]);

        return redirect()->route('sidang_values.index')->with('success', 'Nilai berhasil disimpan.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SidangValue $sidangValue)
    {
        // $this->authorize('update', $sidangValue); // Optional: gunakan policy

        $schedules = SidangSchedule::all();
        return view('sidang_values.edit', compact('sidangValue', 'schedules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SidangValue $sidangValue)
    {
        $request->validate([
            'nilai' => 'required|integer|min:0|max:100',
            'komentar' => 'nullable|string',
        ]);

        $sidangValue->update([
            'nilai' => $request->nilai,
            'komentar' => $request->komentar,
        ]);

        return redirect()->route('sidang_values.index')->with('success', 'Data nilai sidang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SidangValue $sidangValue)
    {
        $this->authorize('delete', $sidangValue); // Optional

        $sidangValue->delete();
        return redirect()->route('sidang_values.index')->with('success', 'Data nilai sidang berhasil dihapus.');
    }
}
