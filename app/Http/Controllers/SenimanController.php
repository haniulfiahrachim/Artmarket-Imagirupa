<?php

namespace App\Http\Controllers;

use App\Models\Karya;
use App\Models\User;
use Illuminate\Http\Request;

class SenimanController extends Controller
{
    /**
     * Halaman daftar semua seniman terverifikasi
     */
    public function index(Request $request)
    {
        $query = User::with(['profile', 'karyas'])
            ->where('role', 'seniman')
            ->where('status_akun', 'verified');

        // Search by nama / spesialisasi
        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('nama', 'like', '%' . $keyword . '%')
                  ->orWhereHas('profile', function ($p) use ($keyword) {
                      $p->where('spesialisasi', 'like', '%' . $keyword . '%')
                        ->orWhere('kota', 'like', '%' . $keyword . '%');
                  });
            });
        }

        // Filter spesialisasi
        if ($request->filled('spesialisasi')) {
            $query->whereHas('profile', fn($p) =>
                $p->where('spesialisasi', 'like', '%' . $request->spesialisasi . '%')
            );
        }

        $senimans = $query->withCount([
                'karyas as total_karya' => fn($q) => $q->where('status_karya', 'tersedia'),
                'karyas as total_terjual' => fn($q) => $q->where('status_karya', 'terjual'),
            ])
            ->orderByDesc('total_karya')
            ->paginate(12)
            ->withQueryString();

        // Ambil semua spesialisasi untuk filter dropdown
        $spesialisasiList = \App\Models\Profile::whereNotNull('spesialisasi')
            ->whereHas('user', fn($q) => $q->where('role','seniman')->where('status_akun','verified'))
            ->pluck('spesialisasi')
            ->flatMap(fn($s) => array_map('trim', explode(',', $s)))
            ->unique()
            ->filter()
            ->sort()
            ->values();

        return view('public.seniman.index', compact('senimans', 'spesialisasiList'));
    }

    /**
     * Halaman profil portofolio seniman
     */
    public function show(User $user)
    {
        if (!$user->isSeniman() || !$user->isVerified()) {
            abort(404);
        }

        $user->load('profile');

        // Karya dengan pagination
        $karyas = Karya::where('seniman_id', $user->id)
            ->latest()
            ->paginate(9);

        // Statistik
        $stats = [
            'total_karya'   => Karya::where('seniman_id', $user->id)->count(),
            'karya_tersedia'=> Karya::where('seniman_id', $user->id)->where('status_karya', 'tersedia')->count(),
            'karya_terjual' => Karya::where('seniman_id', $user->id)->where('status_karya', 'terjual')->count(),
        ];

        // Karya featured (3 terbaru tersedia)
        $karyaFeatured = Karya::where('seniman_id', $user->id)
            ->where('status_karya', 'tersedia')
            ->latest()
            ->limit(3)
            ->get();

        return view('public.seniman.show', compact('user', 'karyas', 'stats', 'karyaFeatured'));
    }
}
