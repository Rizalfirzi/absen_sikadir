<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skp extends Model
{
    use HasFactory;

    protected $table = 'skp';
    public $timestamps = false;

    protected $fillable = [
        'id', 'nip', 'nilai', 'persentase', 'tahun','ket'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'nip');
    }

    public function satker()
    {
        return $this->belongsTo(Satker::class, 'satker_id');
    }
}
