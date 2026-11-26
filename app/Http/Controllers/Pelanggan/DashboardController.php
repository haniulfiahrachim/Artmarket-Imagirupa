<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $stats = [
            'total_pesanan'   => Pesanan::where('pelanggan_id', $user->id)->count(),
            'pesanan_pending' => Pesanan::where('pelanggan_id', $user->id)->where('status_pesanan', 'pending')->count(),
            'pesanan_selesai' => Pesanan::where('pelanggan_id', $user->id)->where('status_pesanan', 'selesai')->count(),
        ];

        $pesananTerbaru = Pesanan::with(['karya.seniman', 'pembayaran'])
            ->where('pelanggan_id', $user->id)
            ->latest()
            ->limit(5)
            ->get();

        return view('pelanggan.dashboard', compact('stats', 'pesananTerbaru'));
    }
}
