<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tukin extends Model
{
    use HasFactory;

    protected $table = 't_tukin_matang';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nip', 'nama', 'gradejabatan', 'harga_jabatan', 'skp_persentase', 'tukin_dasar',
        'tukin_terima', 'cuti_besar', 'cuti_besar_pot', 'cuti_penting', 'cuti_penting_pot',
        'cuti_lahir', 'cuti_lahir_pot', 'tubel', 'tubel_pot', 'izin', 'izin_pot',
        'tk', 'tk_pot', 'telat_tl', 'psw', 'total_kjk', 'kjk_pot', 'bulan', 'tahun', 'tot_potongan'
    ];

    public function hargaJabatan()
    {
        return $this->belongsTo(HargaJabatan::class, 'gradejabatan', 'peringkat_jabatan');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'nip');
    }
}
