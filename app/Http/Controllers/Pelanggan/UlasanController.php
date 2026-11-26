<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Ulasan;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    public function store(Request $request, Pesanan $pesanan)
    {
        // Hanya pelanggan yang punya pesanan ini
        if ($pesanan->pelanggan_id !== auth()->id()) {
            abort(403);
        }

        // Hanya bisa ulasan jika pesanan sudah selesai
        if ($pesanan->status_pesanan !== 'selesai') {
            return back()->with('error', 'Ulasan hanya bisa diberikan setelah pesanan selesai.');
        }

        // Cek sudah pernah beri ulasan
        if ($pesanan->ulasan) {
            return back()->with('error', 'Anda sudah memberikan ulasan untuk pesanan ini.');
        }

        $request->validate([
            'rating'   => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:1000',
        ], [
            'rating.required' => 'Pilih rating bintang.',
            'rating.min'      => 'Rating minimal 1 bintang.',
            'rating.max'      => 'Rating maksimal 5 bintang.',
        ]);

        Ulasan::create([
            'karya_id'     => $pesanan->karya_id,
            'pelanggan_id' => auth()->id(),
            'pesanan_id'   => $pesanan->id,
            'rating'       => $request->rating,
            'komentar'     => $request->komentar,
        ]);

        return back()->with('success', 'Terima kasih! Ulasan Anda berhasil disimpan.');
    }

    public function destroy(Ulasan $ulasan)
    {
        if ($ulasan->pelanggan_id !== auth()->id()) {
            abort(403);
        }

        $ulasan->delete();
        return back()->with('success', 'Ulasan berhasil dihapus.');
    }
}