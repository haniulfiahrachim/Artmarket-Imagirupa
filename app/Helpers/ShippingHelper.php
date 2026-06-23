<?php

namespace App\Helpers;

class ShippingHelper
{
    /**
     * Hitung jarak Haversine (km)
     */
    public static function hitungJarak(
        float $lat1, float $lon1,
        float $lat2, float $lon2
    ): float {
        $R    = 6371;
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a    = sin($dLat / 2) ** 2
              + cos(deg2rad($lat1)) * cos(deg2rad($lat2))
              * sin($dLon / 2) ** 2;

        return round($R * 2 * atan2(sqrt($a), sqrt(1 - $a)), 2);
    }

    /**
     * Hitung biaya pengiriman berdasarkan jarak
     */
    public static function hitungBiaya(float $jarakKm): array
    {
        $config = config('shipping');

        if ($jarakKm > $config['jarak_maksimum']) {
            return [
                'biaya'  => 0,
                'error'  => "Maaf, layanan antar hanya tersedia untuk jarak ≤ {$config['jarak_maksimum']} km dari toko.",
                'status' => 'out_of_range',
            ];
        }

        if ($config['pakai_zona']) {
            foreach ($config['zona'] as $zona) {
                if ($jarakKm <= $zona['max_km']) {
                    return [
                        'biaya'       => $zona['biaya'],
                        'zona_label'  => $zona['label'],
                        'status'      => 'ok',
                    ];
                }
            }
            // fallback zona terakhir
            $last = end($config['zona']);
            return [
                'biaya'      => $last['biaya'],
                'zona_label' => $last['label'],
                'status'     => 'ok',
            ];
        }

        // Mode per-km
        $biaya = max(
            $config['tarif_minimum'],
            min($config['tarif_maksimum'], (int) ceil($jarakKm) * $config['tarif_per_km'])
        );

        return ['biaya' => $biaya, 'zona_label' => null, 'status' => 'ok'];
    }

    public static function formatRupiah(int $nominal): string
    {
        return 'Rp ' . number_format($nominal, 0, ',', '.');
    }

    /**
     * Tabel zona untuk ditampilkan ke user
     */
    public static function tabelZona(): array
    {
        return config('shipping.zona', []);
    }
}