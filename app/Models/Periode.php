<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function m_periode()
    {
        return $this->hasMany(Periode::class, 'periode_id', 'id');
    }
}
