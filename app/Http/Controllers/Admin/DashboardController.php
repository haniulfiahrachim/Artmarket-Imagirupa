<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karya;
use App\Models\Pembayaran;
use App\Models\Pesanan;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users'      => User::count(),
            'total_seniman'    => User::where('role', 'seniman')->count(),
            'total_pelanggan'  => User::where('role', 'pelanggan')->count(),
            'total_karya'      => Karya::count(),
            'total_pesanan'    => Pesanan::count(),
            'pesanan_pending'  => Pesanan::where('status_pesanan', 'pending')->count(),
            'total_pembayaran' => Pembayaran::where('status_pembayaran', 'disetujui')->count(),
            'seniman_pending'  => User::where('role', 'seniman')->where('status_akun', 'pending')->count(),
        ];

        $pesananTerbaru = Pesanan::with(['pelanggan', 'karya'])
            ->latest()
            ->limit(5)
            ->get();

        $pembayaranMenunggu = Pembayaran::with(['pesanan.pelanggan', 'pesanan.karya'])
            ->where('status_pembayaran', 'menunggu')
            ->latest()
            ->limit(5)
            ->get();

        // Data chart per bulan (6 bulan terakhir)
        $chartData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $chartData[] = [
                'bulan'   => $month->format('M Y'),
                'pesanan' => Pesanan::whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)->count(),
                'revenue' => Pesanan::whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->where('status_pesanan', 'selesai')
                    ->sum('total_harga'),
            ];
        }

        return view('admin.dashboard', compact('stats', 'pesananTerbaru', 'pembayaranMenunggu', 'chartData'));
    }
}
