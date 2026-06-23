<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
        'status_akun',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    // Relationships
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function karyas()
    {
        return $this->hasMany(Karya::class, 'seniman_id');
    }

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class, 'pelanggan_id');
    }

    public function chatsDikirim()
    {
        return $this->hasMany(Chat::class, 'pengirim_id');
    }

    public function chatsDiterima()
    {
        return $this->hasMany(Chat::class, 'penerima_id');
    }

    // Role helpers
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isSeniman(): bool
    {
        return $this->role === 'seniman';
    }

    public function isPelanggan(): bool
    {
        return $this->role === 'pelanggan';
    }

    public function isVerified(): bool
    {
        return $this->status_akun === 'verified';
    }
}
