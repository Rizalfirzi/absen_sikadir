<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tjamkerja extends Model
{
    use HasFactory;

    protected $table = 't_jamkerja';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['tgl_awal', 'tgl_akhir', 'jam_masuk', 'jam_keluar', 'ket', 'hari'];

}
