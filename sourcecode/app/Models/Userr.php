<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['name','nim','email','password','role'];

    public function laporan()
    {
        return $this->hasMany(Laporan::class);
    }

    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class);
    }
}

