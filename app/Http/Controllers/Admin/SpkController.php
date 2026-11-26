<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karya;

class SpkController extends Controller
{
    // Bobot kriteria (total harus = 1.0)
    private array $bobot = [
        'c1' => 0.40,  // Penjualan       40%
        'c2' => 0.30,  // Rating Produk   30%
        'c3' => 0.30,  // Ulasan Positif  30%
    ];

    public function index()
    {
        // ── Ambil semua karya beserta data pesanan & ulasan ──────────
        $karyas = Karya::with([
            'seniman',
            'pesanans' => fn($q) => $q->where('status_pesanan', 'selesai'),
            'ulasans',
        ])->get();

        // ── Bangun Matriks X (Data Awal) ─────────────────────────────
        $matriksX = $karyas->map(function ($karya) {
            $c1 = $karya->pesanans->count(); // total terjual (selesai)
            $c2 = round($karya->ulasans->avg('rating') ?? 0, 2); // rata-rata rating
            $c3 = $karya->ulasans->where('rating', '>=', 4)->count(); // ulasan positif

            return [
                'id'       => $karya->id,
                'judul'    => $karya->judul,
                'seniman'  => $karya->seniman->nama ?? '-',
                'gambar'   => $karya->gambar,
                'harga'    => $karya->harga,
                'status'   => $karya->status_karya,
                'c1'       => $c1,
                'c2'       => $c2,
                'c3'       => $c3,
            ];
        })->values();

        // ── Nilai Maksimum setiap kriteria (Benefit = max) ───────────
        $maxC1 = $matriksX->max('c1') ?: 1;
        $maxC2 = $matriksX->max('c2') ?: 1;
        $maxC3 = $matriksX->max('c3') ?: 1;

        // ── Normalisasi Matriks R + Hitung Nilai Preferensi (V) ──────
        $matriksR = $matriksX->map(function ($item) use ($maxC1, $maxC2, $maxC3) {
            $r1 = $maxC1 > 0 ? round($item['c1'] / $maxC1, 4) : 0;
            $r2 = $maxC2 > 0 ? round($item['c2'] / $maxC2, 4) : 0;
            $r3 = $maxC3 > 0 ? round($item['c3'] / $maxC3, 4) : 0;

            $v = round(
                ($this->bobot['c1'] * $r1) +
                ($this->bobot['c2'] * $r2) +
                ($this->bobot['c3'] * $r3),
                4
            );

            return array_merge($item, [
                'r1' => $r1,
                'r2' => $r2,
                'r3' => $r3,
                'v'  => $v,
            ]);
        });

        // ── Hasil Perangkingan (urut V descending) ───────────────────
        $perangkingan = $matriksR->sortByDesc('v')->values();

        return view('admin.spk.index', [
            'matriksX'    => $matriksX,
            'matriksR'    => $matriksR->values(),
            'perangkingan'=> $perangkingan,
            'bobot'       => $this->bobot,
            'maxC1'       => $maxC1,
            'maxC2'       => $maxC2,
            'maxC3'       => $maxC3,
        ]);
    }
}