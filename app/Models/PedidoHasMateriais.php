<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoHasMateriais extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedido_id',
        'material_id',
        'quantidade',
        'sub_total',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function material()
    {
        return $this->belongsTo(Materiais::class);
    }
}
