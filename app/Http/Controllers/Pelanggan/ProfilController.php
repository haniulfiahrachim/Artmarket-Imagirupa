<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfilController extends Controller
{
    public function edit()
    {
        $user = auth()->user()->load('profile');
        return view('pelanggan.profil.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'bio'  => 'nullable|string|max:1000',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = auth()->user();
        $user->update(['nama' => $request->nama]);

        $profileData = ['bio' => $request->bio];

        if ($request->hasFile('foto')) {
            $profile = $user->profile;
            if ($profile && $profile->foto && file_exists(public_path('uploads/profil/' . $profile->foto))) {
                unlink(public_path('uploads/profil/' . $profile->foto));
            }
            $fotoName = Str::uuid() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads/profil'), $fotoName);
            $profileData['foto'] = $fotoName;
        }

        Profile::updateOrCreate(['user_id' => $user->id], $profileData);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
