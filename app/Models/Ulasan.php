<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $fillable = [
        'karya_id',
        'pelanggan_id',
        'pesanan_id',
        'rating',
        'komentar',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    public function karya()
    {
        return $this->belongsTo(Karya::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(User::class, 'pelanggan_id');
    }

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }

    public function getStarHtmlAttribute(): string
    {
        $html = '';
        for ($i = 1; $i <= 5; $i++) {
            $html .= $i <= $this->rating
                ? '<i class="bi bi-star-fill" style="color:#F39C12;"></i>'
                : '<i class="bi bi-star" style="color:#ddd;"></i>';
        }
        return $html;
    }

    public function getLabelRatingAttribute(): string
    {
        return match($this->rating) {
            1 => 'Sangat Buruk',
            2 => 'Buruk',
            3 => 'Cukup',
            4 => 'Bagus',
            5 => 'Sangat Bagus',
            default => '-',
        };
    }
}