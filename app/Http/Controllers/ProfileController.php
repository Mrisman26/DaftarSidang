<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Prodi;
use App\Models\MahasiswaProfile;
use App\Models\DosenProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = Auth::user();
        $prodis = Prodi::all(); // Mengambil semua program studi

        // Pastikan profil mahasiswa sudah ter-load
        $mahasiswaProfile = $user->mahasiswaProfile;

        $dosenProfile = $user->dosenProfile;


        return view('profile.edit', compact('user', 'prodis', 'mahasiswaProfile', 'dosenProfile'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();

        // Validasi umum
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string|max:255',
        ]);

        // Validasi NIM atau NIDN sesuai role
        if ($user->hasRole('Mahasiswa')) {
            $request->validate([
                'nim' => 'required|string|max:50',
                'prodi_id' => 'required|exists:prodis,id',
            ]);
        } elseif ($user->hasRole('Dosen')) {
            $request->validate([
                'nidn' => 'required|string|max:50',
                'prodi_id' => 'required|exists:prodis,id',
            ]);
        }

        // Update user (name & email)
        $user->fill($request->only('name', 'email'));

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // -----------------------------
        // 1️⃣ Update table profiles
        // -----------------------------
        \App\Models\Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
            ]
        );

        // -----------------------------
        // 2️⃣ Update mahasiswa/dosen profile
        // -----------------------------
        if ($user->hasRole('Mahasiswa')) {
            \App\Models\MahasiswaProfile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nim' => $request->nim,
                    'prodi_id' => $request->prodi_id,
                ]
            );
        } elseif ($user->hasRole('Dosen')) {
            \App\Models\DosenProfile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nidn' => $request->nidn,
                    'prodi_id' => $request->prodi_id,
                ]
            );
        }

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
