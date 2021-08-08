<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jja extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function m_jja()
    {
        return $this->hasMany(Jja::class, 'jja_id', 'id');
    }
}
