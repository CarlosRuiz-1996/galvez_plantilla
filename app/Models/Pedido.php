<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    public function hospital()
    {
        return $this->belongsTo('App\Models\Hospital', 'hospital_id');
    }

    
    public function detalles()
    {
        return $this->hasMany('App\Models\DetallePedido');
    }
}
