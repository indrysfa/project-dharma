<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembangan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function m_periode()
    {
        return $this->belongsTo(Periode::class, 'periode_id', 'id');
    }

    public function m_jenis_pengdiri()
    {
        return $this->belongsTo(Jenis_pengdiri::class, 'jenis_pengdiri_id', 'id');
    }

    public function m_dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id', 'id');
    }
}
