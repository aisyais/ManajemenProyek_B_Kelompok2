<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lampiran extends Model
{
    protected $fillable = ['laporan_id','file_path','caption'];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }
}

