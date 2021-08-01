<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'user_id','name', 'status'];

    public function m_dosen()
    {
        return $this->hasMany(Dosen::class, 'dosen_id', 'id');
    }
}
