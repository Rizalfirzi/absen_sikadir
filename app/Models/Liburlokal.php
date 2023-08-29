<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liburlokal extends Model
{
    use HasFactory;
    protected $table = 'liburlokal';
    protected $primaryKey = 'kdliburlokal';
    public $timestamps = false;
    protected $fillable = ['tanggal', 'kdunitkerja', 'keterangan'];

}
