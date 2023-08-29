<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HargaJabatan extends Model
{
    use HasFactory;
    protected $table = 'harga_jabatan';
    public $timestamps = false;

    protected $fillable = [
        'peringkat_jabatan',
        'harga_jabatan',
        'harga_jabatan2',
    ];

    public function tukinMatangs()
    {
        return $this->hasMany(Tukin::class, 'gradejabatan', 'peringkat_jabatan');
    }
}
