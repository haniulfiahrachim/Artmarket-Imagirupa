<?php

namespace App\Http\Controllers\Seniman;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        $query = Pesanan::with(['pelanggan', 'karya', 'pembayaran'])
            ->whereHas('karya', fn($q) => $q->where('seniman_id', auth()->id()));

        if ($request->filled('status')) {
            $query->where('status_pesanan', $request->status);
        }

        $pesanans = $query->latest()->paginate(10)->withQueryString();
        return view('seniman.pesanan.index', compact('pesanans'));
    }

    public function show(Pesanan $pesanan)
    {
        if ($pesanan->karya->seniman_id !== auth()->id()) {
            abort(403);
        }
        $pesanan->load(['pelanggan', 'karya', 'pembayaran', 'chats.pengirim']);
        return view('seniman.pesanan.show', compact('pesanan'));
    }

    public function updateStatus(Request $request, Pesanan $pesanan)
{
    if ($pesanan->karya->seniman_id !== auth()->id()) {
        abort(403);
    }

    $request->validate([
        'status_pesanan' => 'required|in:diproses,selesai',
    ]);

    if ($pesanan->status_pesanan !== 'dibayar' && $request->status_pesanan === 'diproses') {
        return back()->with('error', 'Pesanan belum dibayar.');
    }

    $pesanan->update(['status_pesanan' => $request->status_pesanan]);

    // Jika selesai, kurangi stok karya
    // Karya otomatis terjual hanya jika stok habis
    if ($request->status_pesanan === 'selesai') {
        $pesanan->karya->kurangiStok();
    }

    return back()->with('success', 'Status pesanan berhasil diperbarui.');
}
}
