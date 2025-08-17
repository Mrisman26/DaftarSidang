<?php

namespace App\Http\Controllers;

use App\Models\Enter;
use App\Models\PeriodeSidang;
use App\Models\Prodi;
use Illuminate\Http\Request;

class PeriodeSidangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $periodes = PeriodeSidang::latest()->get();
        return view('periode_sidang.index', compact('periodes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         // Ambil data prodi untuk dropdown
        $prodis = Prodi::all();

        return view('periode_sidang.create', compact('prodis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        // Validasi input
        $validated = $request->validate([
            'prodi_id' => 'required|exists:prodis,id',
            'nama_periode' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'is_aktif' => 'required|in:Akan Datang,Aktif,Selesai',
        ]);

        // Update semua periode dari prodi tersebut jadi 'Selesai'
        if ($validated['is_aktif'] === 'Aktif') {
            PeriodeSidang::where('prodi_id', $validated['prodi_id'])
                ->update(['is_aktif' => 'Selesai']);
        }

        // Buat periode baru
        PeriodeSidang::create([
            'prodi_id' => $validated['prodi_id'],
            'nama_periode' => $validated['nama_periode'],
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'is_aktif' => $validated['is_aktif']
        ]);

        return redirect()->route('periode_sidang.index')->with('success', 'Periode berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Enter $enter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Ambil data prodi untuk dropdown
        $prodis = Prodi::all();

        $periode_sidang = PeriodeSidang::all()->findOrFail($id);
        return view('periode_sidang.edit', compact('periode_sidang', 'prodis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PeriodeSidang $periode_sidang)
    {
        $request->validate([
            'prodi_id' => 'required|exists:prodis,id',
            'nama_periode' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'is_aktif' => 'required|in:Akan Datang,Aktif,Selesai',
        ]);

        $periode_sidang->update($request->all());

        return redirect()->route('periode_sidang.index')->with('success', 'Periode berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PeriodeSidang $periode_sidang)
    {
        $periode_sidang->delete();

        return redirect()->route('periode_sidang.index')->with('success', 'Periode berhasil dihapus.');
    }
}
