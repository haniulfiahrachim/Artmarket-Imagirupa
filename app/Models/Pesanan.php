<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelanggan_id',
        'karya_id',
        'tanggal_pesanan',
        'total_harga',
        'status_pesanan',
        'opsi_pengambilan',
        'alamat_pengiriman',
        'biaya_pengiriman',
        'jarak_km',         
    ];

    protected $casts = [
        'tanggal_pesanan'  => 'date',
        'total_harga'      => 'decimal:2',
        'biaya_pengiriman' => 'decimal:2',
        'jarak_km'         => 'decimal:2', 
    ];

    public function pelanggan()
    {
        return $this->belongsTo(User::class, 'pelanggan_id');
    }

    public function karya()
    {
        return $this->belongsTo(Karya::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function getTotalHargaFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->total_harga, 0, ',', '.');
    }

    public function getBiayaPengirimanFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->biaya_pengiriman, 0, ',', '.');
    }

    public function getGrandTotalAttribute(): float
    {
        return (float) $this->total_harga + (float) $this->biaya_pengiriman;
    }

    public function getGrandTotalFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->grand_total, 0, ',', '.');
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status_pesanan) {
            'pending'  => '<span class="badge bg-warning text-dark">Pending</span>',
            'dibayar'  => '<span class="badge bg-info">Dibayar</span>',
            'diproses' => '<span class="badge bg-primary">Diproses</span>',
            'selesai'  => '<span class="badge bg-success">Selesai</span>',
            default    => '<span class="badge bg-secondary">Unknown</span>',
        };
    }

    public function getOpsiPengambilanLabelAttribute(): string
    {
        return match($this->opsi_pengambilan) {
            'antar'        => '<span class="badge bg-info text-white"><i class="bi bi-truck me-1"></i>Layanan Antar</span>',
            'ambil_sendiri'=> '<span class="badge bg-success"><i class="bi bi-shop me-1"></i>Ambil Sendiri</span>',
            default        => '<span class="badge bg-secondary">Belum dipilih</span>',
        };
    }

    public function ulasan()
{
    return $this->hasOne(Ulasan::class);
}
}