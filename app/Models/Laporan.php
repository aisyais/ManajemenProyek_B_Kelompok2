<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    
    
    protected $guarded = []; 

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tanggapan() 
    {
        return $this->hasOne(Tanggapan::class); 
    }
}

