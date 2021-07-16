<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis_pengdiri extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function m_jenis_pengdiri()
    {
        return $this->hasMany(Jenis_pengdiri::class, 'jenis_pengdiri_id', 'id');
    }
}
