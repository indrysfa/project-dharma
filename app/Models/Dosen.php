<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function m_dosen()
    {
        return $this->hasMany(Dosen::class, 'dosen_id', 'id');
    }

    public function m_jja()
    {
        return $this->belongsTo(Jja::class, 'jja_id', 'id');
    }
}
