<?php

namespace App\Http\Controllers;

use App\Models\Enter;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil dosen dengan relasi profile, dosenProfile, dan prodi (dari dosenProfile)
        // $dosen = User::role('dosen')
        // ->with(['profile', 'dosenProfile.prodi'])
        // ->whereHas('dosenProfile') // Pastikan hanya dosen yang punya dosenProfile
        // ->get()
        // ->sortBy([
        //     fn ($a, $b) => strcmp($a->dosenProfile->prodi->nama_prodi ?? 'ZZZ', $b->dosenProfile->prodi->nama_prodi ?? 'ZZZ'),
        //     fn ($a, $b) => strcmp($a->name, $b->name),
        // ]);

        $dosen = User::whereHas('dosenProfile')
        ->with(['profile', 'dosenProfile.prodi'])
        ->orderBy('created_at', 'desc')
        ->get();


        return view('dosen.index', compact('dosen'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodis = Prodi::all(); // Ambil semua prodi untuk dropdown

        return view('dosen.create', compact('prodis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Cek apakah salah satu peran dipilih
        if (!$request->has('is_pembimbing') && !$request->has('is_penguji')) {
            return back()->withErrors(['peran' => 'Minimal pilih salah satu peran: pembimbing atau penguji'])->withInput();
        }

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'nidn' => 'required|digits_between:8,15|unique:dosen_profiles,nidn',
            'prodi_id' => 'required|exists:prodis,id',
            'role' => 'required|in:Dosen,Kaprodi',
            'no_hp' => 'nullable|digits_between:10,15|unique:profiles,no_hp',
            'alamat' => 'nullable|string|max:255',
        ]);

        if ($request->role === 'Kaprodi') {
            $existingKaprodi = User::whereHas('roles', fn ($q) => $q->where('name', 'Kaprodi'))
                ->whereHas('dosenProfile', fn ($q) => $q->where('prodi_id', $request->prodi_id))
                ->exists();

            if ($existingKaprodi) {
                return back()->withErrors(['role' => 'Sudah ada Kaprodi untuk program studi ini.'])->withInput();
            }
        }


        // Buat user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Beri role: Dosen atau Kaprodi
        $user->assignRole($request->role);

        // Buat profile dosen
        $user->dosenProfile()->create([
            'nidn' => $request->nidn,
            'prodi_id' => $request->prodi_id,
            'is_pembimbing' => $request->has('is_pembimbing'),
            'is_penguji' => $request->has('is_penguji'),
        ]);

        // Buat profile umum
        $user->profile()->create([
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Ambil user apapun yang punya dosenProfile
        $dosen = User::whereHas('dosenProfile')
            ->with('dosenProfile')
            ->findOrFail($id);

        return view('dosen.show', compact('dosen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Ambil user dengan relasi dosenProfile dan profile
        $user = User::with(['dosenProfile', 'profile'])->findOrFail($id);

        // Ambil data prodi untuk dropdown
        $prodis = Prodi::all();

        return view('dosen.edit', compact('user', 'prodis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Cek apakah salah satu peran dipilih
        if (!$request->has('is_pembimbing') && !$request->has('is_penguji')) {
            return back()->withErrors(['peran' => 'Minimal pilih salah satu peran: pembimbing atau penguji'])->withInput();
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'nidn' => 'required|digits_between:8,15|unique:dosen_profiles,nidn,' . $user->dosenProfile->id,
            'prodi_id' => 'required|exists:prodis,id',
            'role' => 'required|in:Dosen,Kaprodi',
            'no_hp' => 'nullable|digits_between:10,15|unique:profiles,no_hp,' . optional($user->profile)->id,
            'alamat' => 'nullable|string|max:255',
        ]);

        if ($request->role === 'Kaprodi') {
            $existingKaprodi = User::whereHas('roles', fn ($q) => $q->where('name', 'Kaprodi'))
                ->whereHas('dosenProfile', fn ($q) => $q->where('prodi_id', $request->prodi_id))
                ->where('id', '!=', $user->id) // agar tidak konflik dengan dirinya sendiri saat edit
                ->exists();

            if ($existingKaprodi) {
                return back()->withErrors(['role' => 'Sudah ada Kaprodi untuk program studi ini.'])->withInput();
            }
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        // Update role: remove all first then assign
        $user->syncRoles([$request->role]);

        $user->dosenProfile()->update([
            'nidn' => $request->nidn,
            'prodi_id' => $request->prodi_id,
            'is_pembimbing' => $request->has('is_pembimbing'),
            'is_penguji' => $request->has('is_penguji'),
        ]);

        $user->profile()->updateOrCreate([], [
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('dosen.index')->with('success', 'Data Dosen berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Mencari dosen berdasarkan ID
        $dosen = User::role('Dosen')->findOrFail($id);

        // Menghapus data dosen dan profil terkait
        $dosen->profile()->delete();
        $dosen->delete();

        // Redirect atau response setelah penghapusan
        return redirect()->route('dosen.index')->with('success', 'Data Dosen berhasil dihapus');
    }
}
