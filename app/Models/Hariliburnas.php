<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hariliburnas extends Model
{
    use HasFactory;
    protected $table = 'harilibur';
    protected $primaryKey = 'kdharilibur';
    public $timestamps = false;
    protected $fillable = ['tanggal', 'keterangan'];
}
