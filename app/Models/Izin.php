<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    use HasFactory;

    protected $table = 'izin';
    public $timestamps = false;
    protected $fillable = [
        'nik',
        'tanggal',
        'alasan',
        'jenis',
        'nosurat',
        'deleted',
        'extensi',
        'st',
        'anak'
    ];
}
