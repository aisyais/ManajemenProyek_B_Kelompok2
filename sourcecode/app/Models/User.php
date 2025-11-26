<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // --- TAMBAHKAN BARIS INI (PENTING) ---
    // Ini memberitahu Laravel: "Jangan cari tabel 'users', tapi pakailah 'userrs'"
    protected $table = 'userrs'; 

    protected $fillable = [
        'name',
        'nim',      // Pastikan nim dimasukkan di sini
        'email',
        'password',
        'role',     // Pastikan role dimasukkan di sini
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}