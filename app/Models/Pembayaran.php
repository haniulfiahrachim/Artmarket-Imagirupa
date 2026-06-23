<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'pesanan_id',
        'bukti_pembayaran',
        'tanggal_bayar',
        'status_pembayaran',
    ];

    protected $casts = [
        'tanggal_bayar' => 'date',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }

    public function getBuktiUrlAttribute(): string
    {
        if ($this->bukti_pembayaran) {
            return asset('uploads/pembayaran/' . $this->bukti_pembayaran);
        }
        return '';
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status_pembayaran) {
            'menunggu'  => '<span class="badge bg-warning text-dark">Menunggu</span>',
            'disetujui' => '<span class="badge bg-success">Disetujui</span>',
            'ditolak'   => '<span class="badge bg-danger">Ditolak</span>',
            default     => '<span class="badge bg-secondary">Unknown</span>',
        };
    }
}
