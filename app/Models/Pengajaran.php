<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajaran extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function m_pengajaran()
    {
        return $this->belongsTo(Periode::class, 'periode_id', 'id');
    }
}
