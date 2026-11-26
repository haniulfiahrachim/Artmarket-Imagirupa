<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karya extends Model
{
    use HasFactory;

    protected $fillable = [
        'seniman_id',
        'judul',
        'deskripsi',
        'harga',
        'stok',
        'gambar',
        'status_karya',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'stok'  => 'integer',
    ];

    public function seniman()
    {
        return $this->belongsTo(User::class, 'seniman_id');
    }

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class);
    }

    public function getGambarUrlAttribute(): string
    {
        if ($this->gambar && file_exists(public_path('uploads/karya/' . $this->gambar))) {
            return asset('uploads/karya/' . $this->gambar);
        }
        return asset('img/default-karya.png');
    }

    public function getHargaFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    public function getStokLabelAttribute(): string
    {
        if ($this->status_karya === 'terjual') {
            return '<span class="badge bg-danger">Habis</span>';
        }
        if ($this->stok <= 3) {
            return '<span class="badge bg-warning text-dark">Stok: ' . $this->stok . '</span>';
        }
        return '<span class="badge bg-success">Stok: ' . $this->stok . '</span>';
    }

    public function isAvailable(): bool
    {
        return $this->status_karya === 'tersedia' && $this->stok > 0;
    }

    /**
     * Kurangi stok setelah pesanan selesai.
     * Jika stok habis, ubah status menjadi terjual.
     */
    public function kurangiStok(): void
    {
        $this->stok = max(0, $this->stok - 1);
        if ($this->stok <= 0) {
            $this->status_karya = 'terjual';
        }
        $this->save();
    }

    /**
     * Tambah stok kembali (misal pesanan dibatalkan).
     */
    public function tambahStok(int $jumlah = 1): void
    {
        $this->stok += $jumlah;
        $this->status_karya = 'tersedia';
        $this->save();
    }

    public function ulasans()
{
    return $this->hasMany(Ulasan::class);
}

public function getRatingRataAttribute(): float
{
    return round($this->ulasans()->avg('rating') ?? 0, 1);
}

public function getTotalUlasanAttribute(): int
{
    return $this->ulasans()->count();
}

public function getRatingStarHtmlAttribute(): string
{
    $avg  = $this->rating_rata;
    $html = '';
    for ($i = 1; $i <= 5; $i++) {
        if ($avg >= $i) {
            $html .= '<i class="bi bi-star-fill" style="color:#F39C12;"></i>';
        } elseif ($avg >= $i - 0.5) {
            $html .= '<i class="bi bi-star-half" style="color:#F39C12;"></i>';
        } else {
            $html .= '<i class="bi bi-star" style="color:#ddd;"></i>';
        }
    }
    return $html;
}

public function getTotalTerjualAttribute(): int
{
    // Gunakan nilai dari withCount jika sudah di-eager-load (lebih efisien)
    if (array_key_exists('total_terjual', $this->attributes)) {
        return (int) $this->attributes['total_terjual'];
    }

    return $this->pesanans()->where('status_pesanan', 'selesai')->count();
}

public function getTerjualLabelAttribute(): string
{
    $jumlah = $this->total_terjual;

    if ($jumlah == 0) {
        return '';
    }

    return $jumlah . ' terjual';
}

}