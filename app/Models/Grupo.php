<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grupo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nome',
        'saldo_permitido',
        'aprovador_id',
    ];

    public function aprovador()
    {
        return $this->belongsTo(User::class, 'aprovador_id');
    }
}
