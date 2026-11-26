<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Koordinat Lokasi Imagirupa (titik asal pengiriman)
    |--------------------------------------------------------------------------
    */
    'origin_lat'  => env('STORE_LAT', 0.052605),
    'origin_lng'  => env('STORE_LNG', 109.349651),
    'origin_name' => env('STORE_NAME', 'Imagirupa Art Market, Pontianak'),

    /*
    |--------------------------------------------------------------------------
    | Jarak maksimum layanan antar (km)
    |--------------------------------------------------------------------------
    */
    'jarak_maksimum' => 15,

    /*
    |--------------------------------------------------------------------------
    | Gunakan sistem zona (flat per zona — lebih terjangkau & mudah dipahami)
    |--------------------------------------------------------------------------
    */
    'pakai_zona' => true,

    'zona' => [
        ['max_km' =>  3, 'biaya' => 10000, 'label' => '0 - 3 km'],
        ['max_km' =>  6, 'biaya' => 18000, 'label' => '4 - 6 km'],
        ['max_km' => 20, 'biaya' => 25000, 'label' => '7 - 9 km'],
        
    ],

    /*
    |--------------------------------------------------------------------------
    | Tarif per-km (hanya dipakai jika pakai_zona = false)
    |--------------------------------------------------------------------------
    */
    'tarif_per_km'  => 3000,
    'tarif_minimum' => 8000,
    'tarif_maksimum'=> 50000,
];