<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    // public function productos(){
    //     // llamo a otro modelo
    //     return $this->hasMany('App\Models\Producto');
    // }
    public function producto()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
    public function pedido()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }
}
