<?php

namespace App\Http\Controllers\Seniman;

use App\Http\Controllers\Controller;
use App\Models\Karya;
use App\Models\Pesanan;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $stats = [
            'total_karya'     => Karya::where('seniman_id', $user->id)->count(),
            'karya_tersedia'  => Karya::where('seniman_id', $user->id)->where('status_karya', 'tersedia')->count(),
            'karya_terjual'   => Karya::where('seniman_id', $user->id)->where('status_karya', 'terjual')->count(),
            'total_pesanan'   => Pesanan::whereHas('karya', fn($q) => $q->where('seniman_id', $user->id))->count(),
            'pesanan_pending' => Pesanan::whereHas('karya', fn($q) => $q->where('seniman_id', $user->id))
                ->where('status_pesanan', 'pending')->count(),
        ];

        $pesananTerbaru = Pesanan::with(['pelanggan', 'karya', 'pembayaran'])
            ->whereHas('karya', fn($q) => $q->where('seniman_id', $user->id))
            ->latest()
            ->limit(5)
            ->get();

        return view('seniman.dashboard', compact('stats', 'pesananTerbaru'));
    }
}
