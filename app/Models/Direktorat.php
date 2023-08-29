<?php

namespace App\Models;

use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Direktorat extends Model
{
    use HasFactory;

    protected $table = 'direktorat';

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'direktorat_id');
    }

}
