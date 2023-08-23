<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    use HasFactory;

    // public function productos(){
    //     // llamo a otro modelo
    //     return $this->hasMany('App\Models\Producto');
    // }
    public function producto()
    {
        return $this->belongsTo('App\Models\Producto', 'producto_id');
    }
    public function pedido()
    {
        return $this->belongsTo('App\Models\Pedido', 'pedido_id');
    }
}
