<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis_penelitian extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function m_jenis_penelitian()
    {
        return $this->hasMany(Jenis_penelitian::class, 'jenis_penelitian_id', 'id');
    }
}
