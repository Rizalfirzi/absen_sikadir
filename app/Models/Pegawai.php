<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $table = 't_pegawai';

    public function direktorat()
    {
        return $this->belongsTo(Direktorat::class, 'direktorat_id');
    }

    public function satker()
    {
        return $this->belongsTo(Satker::class, 'satker_id');
    }

    public function ppkSatker()
    {
        return $this->belongsTo(Satker::class, 'ppk_id');
    }

    public function skps()
    {
        return $this->hasMany(Skp::class, 'nip', 'nip');
    }

    public function tukinMatangs()
    {
        return $this->hasMany(Tukin::class, 'nip', 'nip');
    }
    public function tukinMatang()
    {
        return $this->hasMany(TukinMatang::class, 'nip', 'nip');
    }
}
