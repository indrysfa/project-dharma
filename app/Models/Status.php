<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'code'];

    public function m_status()
    {
        return $this->hasMany(Status::class, 'status_id', 'id');
    }
}
