<?php

namespace App\Http\Controllers\Seniman;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfilController extends Controller
{
    public function edit()
    {
        $user = auth()->user()->load('profile');
        return view('seniman.profil.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama'            => 'required|string|max:255',
            'bio'             => 'nullable|string|max:2000',
            'spesialisasi'    => 'nullable|string|max:255',
            'kota'            => 'nullable|string|max:100',
            'link_portofolio' => 'nullable|url',
            'instagram'       => 'nullable|string|max:100',
            'twitter'         => 'nullable|string|max:100',
            'facebook'        => 'nullable|string|max:100',
            'youtube'         => 'nullable|string|max:100',
            'tiktok'          => 'nullable|string|max:100',
            'website'         => 'nullable|string|max:255',
            'foto'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = auth()->user();
        $user->update(['nama' => $request->nama]);

        $profileData = [
            'bio'             => $request->bio,
            'spesialisasi'    => $request->spesialisasi,
            'kota'            => $request->kota,
            'link_portofolio' => $request->link_portofolio,
            'instagram'       => $request->instagram ? ltrim($request->instagram, '@') : null,
            'twitter'         => $request->twitter ? ltrim($request->twitter, '@') : null,
            'facebook'        => $request->facebook,
            'youtube'         => $request->youtube,
            'tiktok'          => $request->tiktok ? ltrim($request->tiktok, '@') : null,
            'website'         => $request->website,
        ];

        if ($request->hasFile('foto')) {
            $profile = $user->profile;
            if ($profile && $profile->foto && file_exists(public_path('uploads/profil/' . $profile->foto))) {
                unlink(public_path('uploads/profil/' . $profile->foto));
            }
            $fotoName = Str::uuid() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads/profil'), $fotoName);
            $profileData['foto'] = $fotoName;
        }

        Profile::updateOrCreate(
            ['user_id' => $user->id],
            $profileData
        );

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
