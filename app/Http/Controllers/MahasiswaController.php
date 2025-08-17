<?php

namespace App\Http\Controllers;

use App\Models\Enter;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil data pengguna dengan role 'mahasiswa' menggunakan Spatie dan relasi profile
        $mahasiswa = User::role('mahasiswa')->with('profile')->get();

        // Mengirim data ke view mahasiswa.index
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodis = Prodi::all(); // Ambil semua prodi untuk dropdown

        return view('mahasiswa.create', compact('prodis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6|confirmed',
        'nim' => 'required|digits_between:8,15|unique:mahasiswa_profiles,nim',
        'prodi_id' => 'required|exists:prodis,id',
        'no_hp' => 'nullable|digits_between:10,15|unique:profiles,no_hp',
        'alamat' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Assign Role Mahasiswa
        $user->assignRole('Mahasiswa');

        // Create Mahasiswa Profile
        $user->mahasiswaProfile()->create([
            'nim' => $request->nim,
            'prodi_id' => $request->prodi_id,
        ]);

        // Create general Profile
        $user->profile()->create([
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Mengambil mahasiswa dengan role 'mahasiswa' dan relasi profile
        $mahasiswa = User::role('mahasiswa')->with('profile')->findOrFail($id);

        // Mengirim data mahasiswa ke view show
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Ambil user dengan relasi mahasiswaProfile dan profile
        $user = User::with(['mahasiswaProfile', 'profile'])->findOrFail($id);

        // Ambil data prodi untuk dropdown
        $prodis = Prodi::all();

        return view('mahasiswa.edit', compact('user', 'prodis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'nim' => 'required|digits_between:8,15|unique:mahasiswa_profiles,nim,' . $user->mahasiswaProfile->id,
            'prodi_id' => 'required|exists:prodis,id',
            'no_hp' => 'nullable|digits_between:10,15|unique:profiles,no_hp,' . optional($user->profile)->id,
            'alamat' => 'nullable|string|max:255',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        $user->mahasiswaProfile()->update([
            'nim' => $request->nim,
            'prodi_id' => $request->prodi_id,
        ]);

        $user->profile()->updateOrCreate([], [
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Mencari mahasiswa berdasarkan ID
        $mahasiswa = User::role('Mahasiswa')->findOrFail($id);

        // Menghapus data sidang registrations yang terkait dengan mahasiswa
        foreach ($mahasiswa->sidangRegistrations as $sidangRegistration) {
            // Menghapus berkas syarat terkait dengan sidang registration
            $sidangRegistration->berkasSyarat()->delete();

            // Menghapus sidang registration
            $sidangRegistration->delete();
        }

        // Menghapus data mahasiswa dan profil terkait
        $mahasiswa->profile()->delete();
        $mahasiswa->delete();

        // Redirect atau response setelah penghapusan
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa dan data sidang berhasil dihapus');
    }
}
