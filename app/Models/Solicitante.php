<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitante extends Model
{
    use HasFactory;

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function grupos()
    {
        return $this->belongsToMany(Grupo::class, 'solicitantes', 'grupo_id', 'user_id');
    }
}
