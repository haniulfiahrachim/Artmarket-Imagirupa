<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Pesanan::with(['pelanggan', 'karya.seniman', 'pembayaran']);

        if ($request->filled('status')) {
            $query->where('status_pesanan', $request->status);
        }
        if ($request->filled('search')) {
            $query->whereHas('pelanggan', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            });
        }

        $pesanans = $query->latest()->paginate(15)->withQueryString();
        return view('admin.transaksi.index', compact('pesanans'));
    }

    public function show(Pesanan $pesanan)
    {
        $pesanan->load(['pelanggan', 'karya.seniman', 'pembayaran', 'chats.pengirim']);
        return view('admin.transaksi.show', compact('pesanan'));
    }

    public function verifikasiPembayaran(Pembayaran $pembayaran)
    {
        $pembayaran->update(['status_pembayaran' => 'disetujui']);
        $pembayaran->pesanan->update(['status_pesanan' => 'dibayar']);

        return back()->with('success', 'Pembayaran berhasil diverifikasi.');
    }

    public function tolakPembayaran(Pembayaran $pembayaran)
    {
        $pembayaran->update(['status_pembayaran' => 'ditolak']);
        return back()->with('success', 'Pembayaran ditolak.');
    }

    public function laporan()
    {
        $pesanans = Pesanan::with(['pelanggan', 'karya', 'pembayaran'])
            ->where('status_pesanan', 'selesai')
            ->latest()
            ->get();

        $totalRevenue = $pesanans->sum('total_harga');
        $totalPesanan = $pesanans->count();

        return view('admin.transaksi.laporan', compact('pesanans', 'totalRevenue', 'totalPesanan'));
    }
}
