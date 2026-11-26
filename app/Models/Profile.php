<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id', 'bio', 'foto', 'link_portofolio',
    'instagram', 'twitter', 'facebook', 'youtube',
    'tiktok', 'website', 'spesialisasi', 'kota',
    'alamat', 'portofolio_file', 'no_hp',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFotoUrlAttribute(): string
    {
        if ($this->foto && file_exists(public_path('uploads/profil/' . $this->foto))) {
            return asset('uploads/profil/' . $this->foto);
        }
        return '';
    }

    public function getSosmedAttribute(): array
    {
        $sosmed = [];
        if ($this->instagram) {
            $h = ltrim($this->instagram, '@');
            $sosmed[] = ['name'=>'Instagram','icon'=>'bi-instagram','url'=>'https://instagram.com/'.$h,'label'=>'@'.$h,'color'=>'#E1306C'];
        }
        if ($this->twitter) {
            $h = ltrim($this->twitter, '@');
            $sosmed[] = ['name'=>'Twitter / X','icon'=>'bi-twitter-x','url'=>'https://twitter.com/'.$h,'label'=>'@'.$h,'color'=>'#000'];
        }
        if ($this->facebook) {
            $url = str_starts_with($this->facebook,'http') ? $this->facebook : 'https://facebook.com/'.$this->facebook;
            $sosmed[] = ['name'=>'Facebook','icon'=>'bi-facebook','url'=>$url,'label'=>$this->facebook,'color'=>'#1877F2'];
        }
        if ($this->youtube) {
            $url = str_starts_with($this->youtube,'http') ? $this->youtube : 'https://youtube.com/@'.$this->youtube;
            $sosmed[] = ['name'=>'YouTube','icon'=>'bi-youtube','url'=>$url,'label'=>$this->youtube,'color'=>'#FF0000'];
        }
        if ($this->tiktok) {
            $h = ltrim($this->tiktok, '@');
            $sosmed[] = ['name'=>'TikTok','icon'=>'bi-tiktok','url'=>'https://tiktok.com/@'.$h,'label'=>'@'.$h,'color'=>'#000'];
        }
        if ($this->website) {
            $url = str_starts_with($this->website,'http') ? $this->website : 'https://'.$this->website;
            $sosmed[] = ['name'=>'Website','icon'=>'bi-globe2','url'=>$url,'label'=>$this->website,'color'=>'#6C3483'];
        }
        if ($this->link_portofolio) {
            $url = str_starts_with($this->link_portofolio,'http') ? $this->link_portofolio : 'https://'.$this->link_portofolio;
            $sosmed[] = ['name'=>'Portofolio','icon'=>'bi-briefcase','url'=>$url,'label'=>'Lihat Portofolio','color'=>'#27ae60'];
        }
        return $sosmed;
    }
}
