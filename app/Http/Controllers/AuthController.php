<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (auth()->check()) {
            return $this->redirectByRole(auth()->user());
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 6 karakter.',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            $user = auth()->user();

            return $this->redirectByRole($user);
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }

    public function showRegister()
    {
        if (auth()->check()) {
            return $this->redirectByRole(auth()->user());
        }
        return view('auth.register');
    }

    public function register(Request $request)
{
    $request->validate([
        'nama'              => 'required|string|max:255',
        'email'             => 'required|email|unique:users,email',
        'password'          => 'required|min:6|confirmed',
        'role'              => 'required|in:seniman,pelanggan',
        'no_hp'             => 'required_if:role,pelanggan|nullable|string|max:20',
        // Seniman optional fields
        'bio'               => 'nullable|string|max:1000',
        'spesialisasi'      => 'nullable|string|max:255',
        'kota'              => 'nullable|string|max:100',
        'alamat'            => 'nullable|string|max:500',
        'link_portofolio'   => 'nullable|url|max:255',
        'instagram'         => 'nullable|string|max:100',
        'twitter'           => 'nullable|string|max:100',
        'facebook'          => 'nullable|string|max:100',
        'youtube'           => 'nullable|string|max:100',
        'tiktok'            => 'nullable|string|max:100',
        'website'           => 'nullable|string|max:255',
        'foto'              => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'portofolio_file'   => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
    ], [
        'nama.required'      => 'Nama wajib diisi.',
        'email.required'     => 'Email wajib diisi.',
        'email.unique'       => 'Email sudah digunakan.',
        'password.required'  => 'Password wajib diisi.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
        'role.required'      => 'Pilih role akun.',
        'foto.image'         => 'Foto harus berupa gambar.',
        'foto.max'           => 'Ukuran foto maksimal 2MB.',
        'portofolio_file.max'=> 'Ukuran file portofolio maksimal 5MB.',
        'no_hp.required_if' => 'No. HP wajib diisi untuk verifikasi pesanan.',
    ]);

    $user = User::create([
        'nama'        => $request->nama,
        'email'       => $request->email,
        'password'    => Hash::make($request->password),
        'role'        => $request->role,
        'status_akun' => $request->role === 'pelanggan' ? 'verified' : 'pending',
    ]);

    // Build profile data
    // Dalam method register(), bagian build profileData:
        $profileData = [
            'user_id'         => $user->id,
            'no_hp'           => $request->no_hp,
            'bio'             => $request->bio,
            'spesialisasi'    => $request->spesialisasi,
            'kota'            => $request->kota,
            // Pelanggan pakai 'alamat', seniman pakai 'alamat_seniman'
            'alamat'          => $request->role === 'pelanggan'
                                    ? $request->alamat
                                    : $request->alamat_seniman,
            'link_portofolio' => $request->link_portofolio,
            'instagram'       => $request->instagram ? ltrim($request->instagram, '@') : null,
            'twitter'         => $request->twitter   ? ltrim($request->twitter, '@')   : null,
            'facebook'        => $request->facebook,
            'youtube'         => $request->youtube,
            'tiktok'          => $request->tiktok    ? ltrim($request->tiktok, '@')    : null,
            'website'         => $request->website,
        ];

    // Upload foto profil
    if ($request->hasFile('foto')) {
        $fotoName = \Illuminate\Support\Str::uuid() . '.' . $request->foto->extension();
        $request->foto->move(public_path('uploads/profil'), $fotoName);
        $profileData['foto'] = $fotoName;
    }

    // Upload file portofolio
    if ($request->hasFile('portofolio_file')) {
        $portoName = \Illuminate\Support\Str::uuid() . '.' . $request->portofolio_file->extension();
        $request->portofolio_file->move(public_path('uploads/portofolio'), $portoName);
        $profileData['portofolio_file'] = $portoName;
    }

    Profile::create($profileData);

    Auth::login($user);

    $msg = $request->role === 'seniman'
        ? 'Registrasi berhasil! Akun Anda sedang menunggu verifikasi admin.'
        : 'Registrasi berhasil! Selamat datang di Imagirupa.';

    return $this->redirectByRole($user)->with('success', $msg);
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }

    private function redirectByRole(User $user)
    {
        return match($user->role) {
            'admin'     => redirect()->route('admin.dashboard'),
            'seniman'   => redirect()->route('seniman.dashboard'),
            'pelanggan' => redirect()->route('pelanggan.dashboard'),
            default     => redirect()->route('home'),
        };
    }
}
