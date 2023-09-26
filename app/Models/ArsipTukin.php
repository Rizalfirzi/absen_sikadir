<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipTukin extends Model
{
    use HasFactory;

    public function direktorat()
    {
        return $this->belongsTo(Direktorat::class, 'direktorat_id');
    }
}
