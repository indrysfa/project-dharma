<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penelitian extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function m_periode()
    {
        return $this->belongsTo(Periode::class, 'periode_id', 'id');
    }

    public function m_status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
}
